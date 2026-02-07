<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Astrology;

use App\Models\AstroProducts;

   use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AstrologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {
        $astrologers = Astrology::with('user')->latest()->paginate(20);
        return view('dashboard.pages.admin.main-services.astrology.index', compact('astrologers'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('dashboard.pages.admin.main-services.astrology.create');
    }


    public function createF()
    {
        return view('website.pages.register.astrology');
    }

    /**
     * Store a newly created resource in storage.
     */
  

public function store(Request $request)
{
    /* ================= VALIDATION ================= */
    $validated = $request->validate([
        'user_type'           => 'required|string|max:255',
        'name'                => 'required|string|max:255',
        'email'               => 'required|email|max:255',
        'gender'              => 'required|in:Male,Other',
        'dob'                 => 'nullable|date',
        'contact_number'      => 'required|string|max:20',
        'whatsapp_number'     => 'nullable|string|max:20',
        'specialization'      => 'required|string|max:255',
        'experience_years'    => 'required|integer|min:0',
        'location'            => 'required|string|max:255',
        'services_offered'    => 'required|string|max:255',
        'other_service'       => 'nullable|string|max:255',
        'add_require'         => 'nullable|string',
    ]);

    /* ================= CREATE OR FETCH USER ================= */
    $user = User::firstOrCreate(
        ['email' => $validated['email']],
        [
            'name'           => $validated['name'],
            'contact_number' => $validated['contact_number'],
            'password'       => Hash::make(Str::random(12)),
        ]
    );

    /* ================= CHECK ALREADY REGISTERED ================= */
    $astro = Astrology::where('ref_id', $user->id)->first();

    if ($astro) {
        return redirect()
            ->back()
            ->with('error', 'You are already registered for this astrology service. Please Login');
    }

    /* ================= SAVE ASTROLOGY ================= */
    Astrology::create([
        'ref_id'             => $user->id,
        'user_type'          => $validated['user_type'],
        'gender'             => $validated['gender'],
        'dob'                => $validated['dob'],
        'whatsapp_number'    => $validated['whatsapp_number'],
        'specialization'     => $validated['specialization'],
        'experience_years'   => $validated['experience_years'],
        'location'           => $validated['location'],
        'services_offered'   => $validated['services_offered'],
        'other_service'      => $validated['other_service'],
        'add_require'        => $validated['add_require'],
    ]);

    if($request->input('redirect')){
        return redirect()
        ->route('admin.astrology.index')
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
    $item = Astrology::with('user')->findOrFail($id);

    return view(
        'dashboard.pages.admin.main-services.astrology.edit',
        compact('item')
    );
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    /* ================= VALIDATION ================= */
    $validated = $request->validate([
        'user_type'           => 'required|string|max:255',
        'name'                => 'required|string|max:255',
        'gender'              => 'required|in:Male,Other',
        'dob'                 => 'nullable|date',
        'contact_number'      => 'required|string|max:20',
        'whatsapp_number'     => 'nullable|string|max:20',
        'specialization'      => 'required|string|max:255',
        'experience_years'    => 'required|integer|min:0',
        'location'            => 'required|string|max:255',
        'services_offered'    => 'required|string|max:255',
        'other_service'       => 'nullable|string|max:255',
        'add_require'         => 'nullable|string',
    ]);

    /* ================= FETCH ASTROLOGY ================= */
    $astro = Astrology::findOrFail($id);

    /* ================= UPDATE USER ================= */
    $astro->user->update([
        'name'           => $validated['name'],
        'contact_number' => $validated['contact_number'],
    ]);

    /* ================= UPDATE ASTROLOGY ================= */
    $astro->update([
        'user_type'          => $validated['user_type'],
        'gender'             => $validated['gender'],
        'dob'                => $validated['dob'],
        'whatsapp_number'    => $validated['whatsapp_number'],
        'specialization'     => $validated['specialization'],
        'experience_years'   => $validated['experience_years'],
        'location'           => $validated['location'],
        'services_offered'   => $validated['services_offered'],
        'other_service'      => $validated['other_service'],
        'add_require'        => $validated['add_require'],
    ]);

    return redirect()
        ->route("admin.astrology.index")
        ->with('success', 'Astrologer profile updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
   public function destroy($id)
{
    $astro = Astrology::findOrFail($id);

    $astro->delete();
    // dd($id);

    return redirect()
        ->route("admin.astrology.index")
        ->with('success', 'Astrologer profile deleted successfully.');
}

}
