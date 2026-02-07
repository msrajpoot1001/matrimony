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
        $kanyadans = PerformKanyadan::with('user')->latest()->paginate(20);
        return view('dashboard.pages.admin.main-services.perform-kanyadan.index', compact('kanyadans'));
    }

     public function create()
    {
        return view('dashboard.pages.admin.main-services.perform-kanyadan.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createF()
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

    /* ================= CHECK ALREADY REGISTERED ================= */
    $astro = PerformKanyadan::where('ref_id', $user->id)->first();

    if ($astro) {
        return redirect()
            ->back()
            ->with('error', 'You are already registered for this perform kanydan service. Please Login');
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

    if($request->input('redirect')){
        return redirect()
        ->route('admin.perform-kanyadan.index')
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
    $item = PerformKanyadan::with('user')->findOrFail($id);

    return view(
        'dashboard.pages.admin.main-services.perform-kanyadan.edit',
        compact('item')
    );
}


  public function update(Request $request, string $id)
{
    /* ================= FIND RECORD ================= */
    $item = PerformKanyadan::findOrFail($id);

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

    /* ================= UPDATE USER ================= */
    $user = User::findOrFail($item->ref_id);

    // Update user email only if provided
    if (!empty($validated['email'])) {
        $user->email = $validated['email'];
    }

    $user->name = $validated['donor_name'];
    $user->contact_number = $validated['contact_number'];
    $user->save();

    /* ================= UPDATE PERFORM KANYADAN ================= */
    $item->update([
        'donor_name'        => $validated['donor_name'],
        'gender'            => $validated['gender'] ?? null,
        'dob'               => $validated['dob'] ?? null,
        'contact_number'    => $validated['contact_number'],
        'whatsapp_number'   => $validated['whatsapp_number'] ?? null,
        'kanyadan_type'     => $validated['kanyadan_type'],
        'donation_amount'   => $validated['donation_amount'] ?? null,
        'transction_id'     => $validated['transction_id'],
        'other_kanyadan'    => $validated['other_kanyadan'] ?? null,
        'blessings'         => $validated['blessings'] ?? null,
    ]);

    /* ================= REDIRECT ================= */
    if ($request->input('redirect')) {
        return redirect()
            ->route('admin.perform-kanyadan.index')
            ->with('success', 'Perform Kanyadan updated successfully.');
    }

    return redirect()
        ->back()
        ->with('success', 'Perform Kanyadan updated successfully.');
}


   public function destroy(string $id)
{
    /* ================= FIND RECORD ================= */
    $item = PerformKanyadan::findOrFail($id);

    /* ================= DELETE RECORD ================= */
    $item->delete();

    /* ================= REDIRECT ================= */
    return redirect()
        ->route('admin.perform-kanyadan.index')
        ->with('success', 'Perform Kanyadan record deleted successfully.');
}

}
