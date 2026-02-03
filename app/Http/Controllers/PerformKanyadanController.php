<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerformKanyadan;

  use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PerformKanyadanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // SHOW ALL
    public function index()
    {
        $kanyadans = PerformKanyadan::latest()->paginate(20);
        return view('dashboard.pages.admin.register.perform-kanyadan', compact('kanyadans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
          return view('website.pages.register.perform-kanyadaan');
    }

    /**
     * Store a newly created resource in storage.
     */
    // STORE


public function store(Request $request)
{
    /* ================= VALIDATION ================= */
    $validated = $request->validate([
        'donor_name'        => 'required|string|max:255',
        'email'             => 'nullable|email|max:255',
        'gender'            => 'nullable|in:Male,Other',
        'dob'               => 'nullable|date',
        'contact_number'    => 'required|string|max:20',
        'whatsapp_number'   => 'nullable|string|max:20',
        'kanyadan_type'     => 'required|string|max:255',
        'donation_amount'   => 'nullable|numeric|min:0',
        'transction_id'     => 'required|string|max:30',
        'other_kanyadan'    => 'nullable|string|max:255',
        'blessings'         => 'nullable|string',
    ]);

    /* ================= CREATE / FETCH USER ================= */
    // Prefer email if available, otherwise fall back to contact number
    if (!empty($validated['email'])) {
        $user = User::firstOrCreate(
            ['email' => $validated['email']],
            [
                'name'           => $validated['donor_name'],
                'contact_number' => $validated['contact_number'],
                'password'       => Hash::make(Str::random(12)),
            ]
        );
    } else {
        $user = User::firstOrCreate(
            ['contact_number' => $validated['contact_number']],
            [
                'name'     => $validated['donor_name'],
                'password' => Hash::make(Str::random(12)),
            ]
        );
    }

    /* ================= SAVE PERFORM KANYADAN ================= */
    PerformKanyadan::create([
        'ref_id'            => $user->id, // ✅ REQUIRED
        'donor_name'        => $validated['donor_name'],
        'gender'            => $validated['gender'] ?? null,
        'dob'               => $validated['dob'] ?? null,
        'contact_number'    => $validated['contact_number'],
        'whatsapp_number'   => $validated['whatsapp_number'] ?? null,
        'kanyadan_type'     => $validated['kanyadan_type'],
        'donation_amount'   => $validated['donation_amount'] ?? null,
        'other_kanyadan'    => $validated['other_kanyadan'] ?? null,
        'blessings'         => $validated['blessings'] ?? null,
    ]);

    return back()->with('success', 'Your Kanyadan donation request has been submitted successfully.');
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
