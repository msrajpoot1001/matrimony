<?php
namespace App\Http\Controllers\Admin;

use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;  

class PaymentGatewayController extends Controller
{

    public function index()
    {
        $items = PaymentGateway::latest()->get();
  return view('admin::payment-gateway.payment-gateway', compact('items'));



    }

    public function create() {}

public function store(Request $request)
{
    $request->validate([
        'gateway_name' => 'required|string',
        'key'          => 'nullable|string',
        'secreat'      => 'nullable|string',
        'is_active'    => 'required|boolean',
    ]);

    $data = $request->only(['gateway_name', 'key', 'secreat', 'is_active']);

    // If new gateway is active -> make others inactive
    if ((int)$data['is_active'] === 1) {
        PaymentGateway::update(['is_active' => 0]);
    }

    // If new gateway is inactive AND table has no active one -> force active
    $hasActive = PaymentGateway::where('is_active', 1)->exists();
    if (!$hasActive && (int)$data['is_active'] === 0) {
        $data['is_active'] = 1;
    }

    PaymentGateway::create($data);

    return redirect()
        ->route('admin-payment-gateway.index')
        ->with('success', 'PaymentGateway added successfully.');
}



    public function edit(string $id)
    {
        $item = PaymentGateway::findOrFail($id);
   return view("admin::payment-gateway.payment-gateway-edit", compact('item'));



    }
public function update(Request $request, string $id)
{
    $item = PaymentGateway::findOrFail($id);

    $request->validate([
        'gateway_name' => 'nullable|string',
        'key'          => 'nullable|string',
        'secreat'      => 'nullable|string',
        'is_active'    => 'required|boolean',
    ]);

    $data = $request->only(['gateway_name', 'key', 'secreat', 'is_active']);

    $newActive = (int) $data['is_active'];
    $isCurrentlyActive = (int) $item->is_active;

    // ✅ CASE 1: User is trying to deactivate this gateway
    if ($newActive === 0 && $isCurrentlyActive === 1) {

        // check if there is ANY other active gateway
        $otherActiveExists = PaymentGateway::where('id', '!=', $item->id)
            ->where('is_active', 1)
            ->exists();

        // ❌ if no other active, block deactivation
        if (!$otherActiveExists) {
            return redirect()
                ->back()
                ->with('error', 'At least one payment gateway must remain active.');
        }
    }

    // ✅ CASE 2: User is activating this gateway
    if ($newActive === 1) {
        // make all others inactive
        PaymentGateway::where('id', '!=', $item->id)
            ->update(['is_active' => 0]);
    }

    $item->update($data);

    return redirect()
        ->route('admin.payment-gateway.index')
        ->with('success', 'PaymentGateway updated successfully.');
}


public function destroy(Request $request, string $id)
{
    $gateway = PaymentGateway::findOrFail($id);

    // ✅ store delete reason (optional)
    $gateway->delete_reason = $request->delete_reason ?? null;
    $gateway->saveQuietly();  // use save() if you want events

    $wasActive = (int) $gateway->is_active === 1;

    // ✅ delete (soft delete if model uses SoftDeletes)
    $gateway->delete();

    // ✅ If deleted gateway was active, activate another one (if exists)
    if ($wasActive) {
        $nextGateway = PaymentGateway::where('is_active', 0)->latest()->first();
        if ($nextGateway) {
            $nextGateway->is_active = 1;
            $nextGateway->save();
        }
    }

    return redirect()
        ->route('admin.payment-gateway.index')
        ->with('success', 'PaymentGateway deleted successfully.');
}


}