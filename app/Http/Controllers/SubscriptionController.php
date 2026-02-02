<?php

// app/Http/Controllers/SubscriptionController.php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{

    public function index()
    {
        $records = Subscription::latest()->get();
        return view('dashboard.pages.admin.services.subscription', compact('records'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscriptions,email',
        ]);

        Subscription::create([
            'email' => $request->email,
        ]);

        return back()->with('success', 'Thank you for subscribing!')->with("subscribe_success","true");
    }



public function destroy(Request $request, $id)
{
    $request->validate([
        'delete_reason' => 'nullable|string|max:255',
    ]);

    $subscription = Subscription::findOrFail($id);

    // Store delete meta before soft delete
    $subscription->update([
        'deleted_by'    => Auth::id(),
        'delete_reason' => $request->delete_reason,
        'is_active'     => false,
    ]);

    // Soft delete
    $subscription->delete();

    return redirect()
        ->back()
        ->with('success', 'Subscription deleted successfully.');
    }


public function update(Request $request, $id)
{
    $request->validate([
        'is_active' => 'required|boolean',
    ]);

    $subscription = Subscription::findOrFail($id);

    $subscription->update([
        'is_active' => $request->is_active,
    ]);

    return redirect()
        ->route('admin.subscription.index')
        ->with('success', 'Subscription status updated successfully.');
}


}
