<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Support;


class SupportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // SHOW ALL
    public function index()
    {
        $supports = Support::latest()->paginate(20);
        return view('dashboard.pages.admin.register.support', compact('supports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('website.pages.register.support');
    }

    /**
     * Store a newly created resource in storage.
     */
     // STORE
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name'            => 'required|string|max:255',
            'email'                => 'nullable|email|max:255',
            'gender'               => 'nullable|in:Male,Other',
            'dob'                  => 'nullable|date',
            'contact_number'       => 'required|string|max:20',
            'whatsapp_number'      => 'nullable|string|max:20',
            'contribution_type'    => 'required|string|max:255',
            'amount'               => 'nullable|numeric|min:0',
            'transction_id'        => 'nullable|string|max:255',
            'other_contribution'   => 'nullable|string|max:255',
            'message'              => 'nullable|string',
        ]);

        Support::create($validated);

        return back()->with('success', 'Your contribution request has been submitted successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
