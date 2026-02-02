<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Pandit;

class PanditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pandits = Pandit::latest()->paginate(20);
        return view('dashboard.pages.admin.register.pandit', compact('pandits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('website.pages.register.pandit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $validated = $request->validate([
        'user_type'             => 'nullable|string|max:255',
        'name'             => 'required|string|max:255',
        'email'            => 'nullable|email|max:255',
        'gender'           => 'nullable|in:Male,Other',
        'dob'              => 'nullable|date',
        'contact_number'   => 'required|string|max:20',
        'whatsapp_number'  => 'nullable|string|max:20',
        'qualification'    => 'required|string|max:255',
        'experience_years' => 'required|integer|min:0',
        'location'         => 'required|string|max:255',

        // ✅ FIX HERE
        'services_offered'   => 'required|array',
        'services_offered.*' => 'string|max:255',

        'other_service'    => 'nullable|string|max:255',
        'add_require'    => 'nullable|string',
        
    ]);

    Pandit::create([
        ...$validated,
        'services_offered' => $validated['services_offered'], // auto JSON
    ]);

    return back()->with('success', 'Pandit Profile Submitted Successfully.');
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
