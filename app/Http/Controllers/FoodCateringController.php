<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodCatering;

class FoodCateringController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // SHOW ALL
    public function index()
    {
        $foodCaterings = FoodCatering::latest()->paginate(20);
        return view('dashboard.pages.admin.register.food-catering', compact('foodCaterings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('website.pages.register.food-catering');
    }

    /**
     * Store a newly created resource in storage.
     */
    // STORE FUNCTION
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_type'         => 'nullable|string|max:255',
            'full_name'         => 'required|string|max:255',
            'email'             => 'nullable|email|max:255',
            'gender'            => 'nullable|in:Male,Other',
            'dob'               => 'nullable|date',
            'contact_number'    => 'required|string|max:20',
            'whatsapp_number'   => 'nullable|string|max:20',
            'experience_years'  => 'required|integer|min:0',
            'location'          => 'required|string|max:255',
            'looking_for'       => 'required|string|max:255',
            'other_service'     => 'nullable|string|max:255',
            'add_require'     => 'nullable|string',
            
        ]);

        FoodCatering::create($validated);

        return back()->with('success', 'Food catering profile submitted successfully.');
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
