<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Razorpay\Api\Api;
use App\Models\Order;
use App\Models\AstroProducts;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    /**
     * Create Razorpay Order
     */
public function createOrder(Request $request, $productId)
{
    $product = AstroProducts::findOrFail($productId);

    try {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|digits_between:10,12',
            'email'   => 'nullable|email',
            'address' => 'required|string|min:5',
            'pincode' => 'nullable|string|max:10',
        ]);
    } catch (ValidationException $e) {
        return response()->json([
            'success' => false,
            'errors'  => $e->errors(),
        ], 422);
    }

    $order = Order::create([
        'order_no'         => 'ORD-' . strtoupper(Str::random(10)),
        'astro_product_id' => $product->id,
        'name'             => $validated['name'],
        'phone'            => $validated['phone'],
        'email'            => $validated['email'] ?? null,
        'pincode'          => $validated['pincode'] ?? null,
        'address'          => $validated['address'],
        'amount'           => $product->price,
        'status'           => 'pending',
    ]);

    $api = new Api(
        config('services.razorpay.key'),
        config('services.razorpay.secret')
    );

    $razorpayOrder = $api->order->create([
        'receipt'  => $order->order_no,
        'amount'   => $product->price * 100,
        'currency' => 'INR',
    ]);

    $order->update([
        'razorpay_order_id' => $razorpayOrder['id'],
    ]);

    return response()->json([
        'success'  => true,
        'key'      => config('services.razorpay.key'),
        'order_id' => $razorpayOrder['id'],
        'amount'   => $product->price * 100,
        'name'     => $order->name,
        'email'    => $order->email,
        'phone'    => $order->phone,
    ]);
}


    /**
     * Verify Payment
     */
public function verifyPayment(Request $request)
{
    $data = $request->all();

    $api = new Api(
        config('services.razorpay.key'),
        config('services.razorpay.secret')
    );

    try {
        // ✅ Always fetch order using razorpay_order_id
        $order = Order::where('razorpay_order_id', $data['razorpay_order_id'])
            ->firstOrFail();

        // ✅ Optional safety check (recommended)
        if (isset($data['product_id']) && $order->astro_product_id != $data['product_id']) {
            throw new \Exception('Product mismatch');
        }

        // ✅ Verify Razorpay signature
        $api->utility->verifyPaymentSignature([
            'razorpay_order_id'    => $order->razorpay_order_id,
            'razorpay_payment_id' => $data['razorpay_payment_id'],
            'razorpay_signature'  => $data['razorpay_signature'],
        ]);

        // ✅ Update order
        $order->update([
            'razorpay_payment_id' => $data['razorpay_payment_id'],
            'razorpay_signature'  => $data['razorpay_signature'],
            'status'              => 'paid',
        ]);

        return response()->json([
            'success' => true,
        ]);

    } catch (\Exception $e) {

        \Log::error('PAYMENT VERIFY FAILED', [
            'error' => $e->getMessage(),
            'data'  => $data,
        ]);

        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
        ], 400);
    }
}

    /**
     * Success Page
     */
    public function success(Order $order)
    {
        return view('website.order-success', compact('order'));
    }
}
