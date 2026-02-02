<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mandap;

class MandapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // SHOW ALL
    public function index()
    {
        $mandaps = Mandap::latest()->paginate();
        return view('dashboard.pages.admin.register.mandap', compact('mandaps'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('website.pages.register.mandap');
    }

    /**
     * Store a newly created resource in storage.
     */
     // STORE FUNCTION
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_type'              => 'required|string|max:255',
            'mandap_for'              => 'required|string|max:255',
            'other_event'             => 'nullable|string|max:255',
            'full_name'               => 'required|string|max:255',
            'email'                   => 'nullable|email|max:255',
            'gender'                  => 'nullable|in:Male,Other',
            'dob'                     => 'nullable|date',
            'contact_number'          => 'required|string|max:20',
            'whatsapp_number'         => 'nullable|string|max:20',
            'place_name'              => 'required|string|max:255',
            'guest_count'             => 'required|integer|min:1',
            'location'                => 'required|string|max:255',
            'preferred_date'          => 'required|date',
            'venue_category'          => 'required|string|max:255',
            'additional_requirements' => 'nullable|string',
        ]);

        Mandap::create($validated);

        return back()->with('success', 'Mandap request submitted successfully.');
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
