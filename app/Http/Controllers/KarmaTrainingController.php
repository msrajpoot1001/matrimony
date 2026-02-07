<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KarmaTraining;
  use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class KarmaTrainingController extends Controller
{

    /**
     * Display a listing of the resource.
     */
     // SHOW ALL
    public function index()
    {
        $karmaTrainings = KarmaTraining::latest()->paginate(20);
        return view('dashboard.pages.admin.main-services.karma-training.index', compact('karmaTrainings'));
    }

      public function create()
    {
        return view('dashboard.pages.admin.main-services.karma-training.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createF()
    {
        return view('website.pages.register.karma-training');
    }

    /**
     * Store a newly created resource in storage.
     */
    // STORE


public function store(Request $request)
{
    // dd($request);
    /* ================= VALIDATION ================= */
    $validated = $request->validate([
        'user_type'         => 'nullable|string|max:255',
        'full_name'         => 'required|string|max:255',
        'email'             => 'nullable|email|max:255',
        'gender'            => 'nullable|in:Male,Other',
        'dob'               => 'nullable|date',
        'contact_number'    => 'required|string|max:20',
        'whatsapp_number'   => 'nullable|string|max:20',
        'qualification'     => 'required|string|max:255',
        'experience_years'  => 'required|integer|min:0',
        'location'          => 'required|string|max:255',
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

    /* ================= CHECK ALREADY REGISTERED ================= */
    $astro = KarmaTraining::where('ref_id', $user->id)->first();

    if ($astro) {
        return redirect()
            ->back()
            ->with('error', 'You are already registered for this karma training service. Please Login');
    }


    /* ================= SAVE KARMA TRAINING ================= */
    KarmaTraining::create([
        'ref_id'            => $user->id, // ✅ REQUIRED
        'user_type'         => $validated['user_type'] ?? null,
        'full_name'         => $validated['full_name'],
        'gender'            => $validated['gender'] ?? null,
        'dob'               => $validated['dob'] ?? null,
        'contact_number'    => $validated['contact_number'],
        'whatsapp_number'   => $validated['whatsapp_number'] ?? null,
        'qualification'     => $validated['qualification'],
        'experience_years'  => $validated['experience_years'],
        'location'          => $validated['location'],
        'add_require'       => $validated['add_require'] ?? null,
    ]);

     if($request->input('redirect')){
        return redirect()
        ->route('admin.karma-training.index')
        ->with('success', 'Astrology request submitted successfully.');
    }else{
        return redirect()
        ->back()
        ->with('success', 'Astrology request submitted successfully.');
    }
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
    $item = KarmaTraining::with('user')->findOrFail($id);

    return view(
        'dashboard.pages.admin.main-services.karma-training.edit',
        compact('item')
    );
}
    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, string $id)
{
    /* ================= VALIDATION ================= */
    $validated = $request->validate([
        'user_type'         => 'nullable|string|max:255',
        'full_name'         => 'required|string|max:255',
        'email'             => 'nullable|email|max:255',
        'gender'            => 'nullable|in:Male,Other',
        'dob'               => 'nullable|date',
        'contact_number'    => 'required|string|max:20',
        'whatsapp_number'   => 'nullable|string|max:20',
        'qualification'     => 'required|string|max:255',
        'experience_years'  => 'required|integer|min:0',
        'location'          => 'required|string|max:255',
        'add_require'       => 'nullable|string',
    ]);

    /* ================= FETCH KARMA TRAINING ================= */
    $karma = KarmaTraining::findOrFail($id);

    /* ================= UPDATE / FETCH USER ================= */
    $user = User::updateOrCreate(
        ['id' => $karma->ref_id], // 🔗 linked user
        [
            'name'           => $validated['full_name'],
            'email'          => $validated['email'],
            'contact_number' => $validated['contact_number'],
        ]
    );

    /* ================= UPDATE KARMA TRAINING ================= */
    $karma->update([
        'user_type'         => $validated['user_type'] ?? null,
        'full_name'         => $validated['full_name'],
        'gender'            => $validated['gender'] ?? null,
        'dob'               => $validated['dob'] ?? null,
        'contact_number'    => $validated['contact_number'],
        'whatsapp_number'   => $validated['whatsapp_number'] ?? null,
        'qualification'     => $validated['qualification'],
        'experience_years'  => $validated['experience_years'],
        'location'          => $validated['location'],
        'add_require'       => $validated['add_require'] ?? null,
    ]);

    /* ================= REDIRECT ================= */
    if ($request->input('redirect')) {
        return redirect()
            ->route('admin.karma-training.index')
            ->with('success', 'Karma Training record updated successfully.');
    }

    return redirect()
        ->back()
        ->with('success', 'Karma Training record updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $id)
{
    $karma = KarmaTraining::findOrFail($id);

    // Delete karma training record (soft delete if enabled)
    $karma->delete();

    return redirect()
        ->route('admin.karma-training.index')
        ->with('success', 'Karma Training record deleted successfully.');
}

}
