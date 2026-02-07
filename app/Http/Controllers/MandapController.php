<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mandap;

   use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MandapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // SHOW ALL
    public function index()
    {
        $mandaps = Mandap::with('user')->latest()->paginate();
        return view('dashboard.pages.admin.main-services.mandap.index', compact('mandaps'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function createF()
    {
         return view('website.pages.register.mandap');
    }
    
     public function create()
    {
         return view('dashboard.pages.admin.main-services.mandap.create');
    }

    /**
     * Store a newly created resource in storage.
     */
     // STORE FUNCTION


public function store(Request $request)
{
    /* ================= VALIDATION ================= */
    $validated = $request->validate([
        'user_type'              => 'required|string|max:255',
        'mandap_for'             => 'required|string|max:255',
        'other_event'            => 'nullable|string|max:255',
        'full_name'              => 'required|string|max:255',
        'email'                  => 'nullable|email|max:255',
        'gender'                 => 'nullable|in:Male,Other',
        'dob'                    => 'nullable|date',
        'contact_number'         => 'required|string|max:20',
        'whatsapp_number'        => 'nullable|string|max:20',
        'place_name'             => 'required|string|max:255',
        'guest_count'            => 'required|integer|min:1',
        'location'               => 'required|string|max:255',
        'preferred_date'         => 'required|date',
        'venue_category'         => 'required|string|max:255',
        'additional_requirements'=> 'nullable|string',
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

     $mandap = Mandap::where('ref_id', $user->id)->first();

    if ($mandap) {
        return redirect()
            ->back()
            ->with('error', 'You are already registered for this mandap service. Please Login');
    }

    /* ================= SAVE MANDAP ================= */
    $user->mandaps()->create([
        'user_type'               => $validated['user_type'],
        'mandap_for'              => $validated['mandap_for'],
        'other_event'             => $validated['other_event'] ?? null,
        'full_name'               => $validated['full_name'],
        'gender'                  => $validated['gender'] ?? null,
        'dob'                     => $validated['dob'] ?? null,
        'whatsapp_number'         => $validated['whatsapp_number'] ?? null,
        'place_name'              => $validated['place_name'],
        'guest_count'             => $validated['guest_count'],
        'location'                => $validated['location'],
        'preferred_date'          => $validated['preferred_date'],
        'venue_category'          => $validated['venue_category'],
        'additional_requirements' => $validated['additional_requirements'] ?? null,
    ]);

     if($request->input('redirect')){
        return redirect()
        ->route('admin.mandap.index')
        ->with('success', 'Mandap request submitted successfully.');
    }else{
        return redirect()
        ->back()
        ->with('success', 'Mandap request submitted successfully.');
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
    $item = Mandap::with('user')->findOrFail($id);

    return view(
        'dashboard.pages.admin.main-services.mandap.edit',
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
        'user_type'               => 'required|string|max:255',
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

    /* ================= FETCH MANDAP ================= */
    $mandap = Mandap::findOrFail($id);
    $user   = $mandap->user; // via relationship

    /* ================= UPDATE USER ================= */
    $user->update([
        'name'           => $validated['full_name'],
        'contact_number' => $validated['contact_number'],
        'email'          => $validated['email'] ?? $user->email,
    ]);

    /* ================= UPDATE MANDAP ================= */
    $mandap->update([
        'user_type'               => $validated['user_type'],
        'mandap_for'              => $validated['mandap_for'],
        'other_event'             => $validated['other_event'] ?? null,
        'full_name'               => $validated['full_name'],
        'gender'                  => $validated['gender'] ?? null,
        'dob'                     => $validated['dob'] ?? null,
        'whatsapp_number'         => $validated['whatsapp_number'] ?? null,
        'place_name'              => $validated['place_name'],
        'guest_count'             => $validated['guest_count'],
        'location'                => $validated['location'],
        'preferred_date'          => $validated['preferred_date'],
        'venue_category'          => $validated['venue_category'],
        'additional_requirements' => $validated['additional_requirements'] ?? null,
    ]);

    /* ================= REDIRECT ================= */
  
        return redirect()
            ->route('admin.mandap.index')
            ->with('success', 'Mandap request updated successfully.');
 
}


    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $id)
{
    $mandap = Mandap::findOrFail($id);

    $mandap->delete();

    return redirect()
        ->back()
        ->with('success', 'Mandap request deleted successfully.');
}

}
