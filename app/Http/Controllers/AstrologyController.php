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
        $astrologers = Astrology::latest()->paginate(20);
        return view('dashboard.pages.admin.register.astrology', compact('astrologers'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function adminCreate()
    {
          $items = AstroProducts::latest()->get();
        return view('dashboard.pages.admin.register-create.astrology',compact('items'));
    }


    public function create()
    {
        return view('website.pages.register.astrology');
    }

    /**
     * Store a newly created resource in storage.
     */
  

public function store(Request $request)
{
//   dd($request);
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
        'experience_years'    => 'required|integer|max:5',
        'location'            => 'required|string|max:255',
        'services_offered'    => 'required|string|max:255',
        'other_service'       => 'nullable|string|max:255',
        'add_require'         => 'nullable|string',
    ]);

    /* ================= CREATE / FETCH USER ================= */
    $user = User::firstOrCreate(
        ['email' => $validated['email']],   // search condition
        [
            'name'           => $validated['name'],
            'contact_number' => $validated['contact_number'],
            'password'       => Hash::make(Str::random(12)), // auto password
        ]
    );

    /* ================= SAVE ASTROLOGY ================= */
    Astrology::create([
        'ref_id'             => $user->id,          // 🔗 link to users
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
        ->back()
        ->with('success', 'Astrologer Profile Submitted Successfully.');
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
