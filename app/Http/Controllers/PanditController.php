<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Pandit;
   use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PanditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pandits = Pandit::latest()->paginate(20);
        return view('dashboard.pages.admin.main-services.pandit.index', compact('pandits'));
    }

    public function create()
    {
        return view('dashboard.pages.admin.main-services.pandit.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createF()
    {
         return view('website.pages.register.pandit');
    }


    /**
     * Store a newly created resource in storage.
     */


public function store(Request $request)
{
    /* ================= VALIDATION ================= */
    $validated = $request->validate([
        'user_type'             => 'nullable|string|max:255',
        'name'                  => 'required|string|max:255',
        'email'                 => 'nullable|email|max:255',
        'gender'                => 'nullable|in:Male,Other',
        'dob'                   => 'nullable|date',
        'contact_number'        => 'required|string|max:20',
        'whatsapp_number'       => 'nullable|string|max:20',
        'qualification'         => 'required|string|max:255',
        'experience_years'      => 'required|integer|min:0',
        'location'              => 'required|string|max:255',

        // services (checkbox/multi-select)
        'services_offered'      => 'required|array',
        'services_offered.*'    => 'string|max:255',

        'other_service'         => 'nullable|string|max:255',
        'add_require'           => 'nullable|string',
    ]);

    /* ================= CREATE / FETCH USER ================= */
    $user = User::firstOrCreate(
        ['email' => $validated['email']], // email unique key
        [
            'name'           => $validated['name'],
            'contact_number' => $validated['contact_number'],
            'password'       => Hash::make(Str::random(12)), // auto password
        ]
    );

    /* ================= CHECK ALREADY REGISTERED ================= */
    $pandit = Pandit::where('ref_id', $user->id)->first();

    if ($pandit) {
        return redirect()
            ->back()
            ->with('error', 'You are already registered for this Pandit / Priest service. Please login.');
    }

    /* ================= SAVE PANDIT ================= */
    Pandit::create([
        'ref_id'               => $user->id,
        'user_type'            => $validated['user_type'],
        'name'                 => $validated['name'],
        'gender'               => $validated['gender'],
        'dob'                  => $validated['dob'],
        'whatsapp_number'      => $validated['whatsapp_number'],
        'qualification'        => $validated['qualification'],
        'experience_years'     => $validated['experience_years'],
        'location'             => $validated['location'],
        'services_offered'     => $validated['services_offered'], // JSON auto-cast
        'other_service'        => $validated['other_service'],
        'add_require'          => $validated['add_require'],
    ]);

    /* ================= REDIRECT ================= */
    if ($request->input('redirect')) {
        return redirect()
            ->route('admin.pandit.index')
            ->with('success', 'Pandit / Priest request submitted successfully.');
    }

    return redirect()
        ->back()
        ->with('success', 'Pandit / Priest request submitted successfully.');
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
    {   $item = Pandit::with('user')->findOrFail($id);
        return view('dashboard.pages.admin.main-services.pandit.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, string $id)
{
    /* ================= VALIDATION ================= */
    $validated = $request->validate([
        'user_type'             => 'nullable|string|max:255',
        'name'                  => 'required|string|max:255',
        'email'                 => 'nullable|email|max:255',
        'gender'                => 'nullable|in:Male,Other',
        'dob'                   => 'nullable|date',
        'contact_number'        => 'required|string|max:20',
        'whatsapp_number'       => 'nullable|string|max:20',
        'qualification'         => 'required|string|max:255',
        'experience_years'      => 'required|integer|min:0',
        'location'              => 'required|string|max:255',

        // services (checkbox/multi-select)
        'services_offered'      => 'required|array',
        'services_offered.*'    => 'string|max:255',

        'other_service'         => 'nullable|string|max:255',
        'add_require'           => 'nullable|string',
    ]);

    /* ================= FETCH PANDIT ================= */
    $pandit = Pandit::findOrFail($id);
    $user   = $pandit->user; // relation via ref_id

    /* ================= UPDATE USER ================= */
    $user->update([
        'name'           => $validated['name'],
        'contact_number' => $validated['contact_number'],
        'email'          => $validated['email'] ?? $user->email,
    ]);

    /* ================= UPDATE PANDIT ================= */
    $pandit->update([
        'user_type'            => $validated['user_type'],
        'name'                 => $validated['name'],
        'gender'               => $validated['gender'],
        'dob'                  => $validated['dob'],
        'whatsapp_number'      => $validated['whatsapp_number'],
        'qualification'        => $validated['qualification'],
        'experience_years'     => $validated['experience_years'],
        'location'             => $validated['location'],
        'services_offered'     => $validated['services_offered'], // JSON auto-cast
        'other_service'        => $validated['other_service'],
        'add_require'          => $validated['add_require'],
    ]);

    /* ================= REDIRECT ================= */
    if ($request->input('redirect')) {
        return redirect()
            ->route('admin.pandit.index')
            ->with('success', 'Pandit / Priest profile updated successfully.');
    }

    return redirect()
        ->back()
        ->with('success', 'Pandit / Priest profile updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $id)
{
    $pandit = Pandit::findOrFail($id);

    $pandit->delete(); // soft delete (because SoftDeletes is used)

    return redirect()
        ->route('admin.pandit.index')
        ->with('success', 'Pandit / Priest profile deleted successfully.');
}

}
