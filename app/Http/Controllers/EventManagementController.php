<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventManagement;
 use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EventManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // SHOW ALL
    public function index()
    {
        $events = EventManagement::latest()->paginate(20);
        return view('dashboard.pages.admin.register.event-management', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('website.pages.register.event-management');
    }

    /**
     * Store a newly created resource in storage.
     */
       // STORE


public function store(Request $request)
{
    /* ================= VALIDATION ================= */
    $validated = $request->validate([
        'user_type'         => 'nullable|string|max:255',
        'full_name'         => 'required|string|max:255',
        'email'             => 'nullable|email|max:255',
        'gender'            => 'required|in:Male,Other',
        'dob'               => 'nullable|date',
        'contact_number'    => 'required|string|max:20',
        'whatsapp_number'   => 'nullable|string|max:20',
        'experience_years'  => 'nullable|integer|min:0',
        'location'          => 'required|string|max:255',
        'services_offered'  => 'required|string|max:255',
        'other_service'     => 'nullable|string|max:255',
        'add_require'       => 'nullable|string',
    ]);

    /* ================= CREATE / FETCH USER ================= */
    $user = User::firstOrCreate(
        ['email' => $validated['email'] ?? null],
        [
            'name'           => $validated['full_name'],
            'contact_number' => $validated['contact_number'],
            'password'       => Hash::make(Str::random(12)),
        ]
    );

    /* ================= SAVE EVENT MANAGEMENT ================= */
    EventManagement::create([
        'ref_id'            => $user->id, // ✅ REQUIRED
        'user_type'         => $validated['user_type'] ?? null,
        'full_name'         => $validated['full_name'],
        'gender'            => $validated['gender'],
        'dob'               => $validated['dob'],
        'contact_number'    => $validated['contact_number'],
        'whatsapp_number'   => $validated['whatsapp_number'] ?? null,
        'experience_years'  => $validated['experience_years'] ?? null,
        'location'          => $validated['location'],
        'services_offered'  => $validated['services_offered'],
        'other_service'     => $validated['other_service'] ?? null,
        'add_require'       => $validated['add_require'] ?? null,
    ]);

    return back()->with('success', 'Event management profile submitted successfully.');
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
