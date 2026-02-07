<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodCatering;
    use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class FoodCateringController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // SHOW ALL
    public function index()
    {
        $foodCaterings = FoodCatering::with('user')->latest()->paginate(20);
        return view('dashboard.pages.admin.main-services.food-catering.index', compact('foodCaterings'));
    }

    public function create()
    {
        return view('dashboard.pages.admin.main-services.food-catering.create',);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function createF()
    {
        return view('website.pages.register.food-catering');
    }


    /**
     * Store a newly created resource in storage.
     */
    // STORE FUNCTION

public function store(Request $request)
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
        'experience_years'  => 'required|integer|min:0',
        'location'          => 'required|string|max:255',
        'looking_for'       => 'required|string|max:255',
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

      /* ================= CHECK ALREADY REGISTERED ================= */
    $f_catering = FoodCatering::where('ref_id', $user->id)->first();

    if ($f_catering) {
        return redirect()
            ->back()
            ->with('error', 'You are already registered for this astrology service. Please Login');
    }

    /* ================= SAVE FOOD CATERING (MODEL ONLY) ================= */
    FoodCatering::create([
        'ref_id'            => $user->id, // ✅ REQUIRED
        'user_type'         => $validated['user_type'] ?? null,
        'full_name'         => $validated['full_name'],
        'gender'            => $validated['gender'] ?? null,
        'dob'               => $validated['dob'] ?? null,
        'whatsapp_number'   => $validated['whatsapp_number'] ?? null,
        'experience_years'  => $validated['experience_years'],
        'location'          => $validated['location'],
        'looking_for'       => $validated['looking_for'],
        'other_service'     => $validated['other_service'] ?? null,
        'add_require'       => $validated['add_require'] ?? null,
    ]);

      if($request->input('redirect')){
        return redirect()
        ->route('admin.food-catering.index')
        ->with('success', 'Food Catering request submitted successfully.');
    }else{
        return redirect()
        ->back()
        ->with('success', 'Food Catering request submitted successfully.');
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
    $item = FoodCatering::with('user')->findOrFail($id);

    return view(
        'dashboard.pages.admin.main-services.food-catering.edit',
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
        'experience_years'  => 'required|integer|min:0',
        'location'          => 'required|string|max:255',
        'looking_for'       => 'required|string|max:255',
        'other_service'     => 'nullable|string|max:255',
        'add_require'       => 'nullable|string',
    ]);

    /* ================= FETCH FOOD CATERING ================= */
    $foodCatering = FoodCatering::findOrFail($id);
    $user = $foodCatering->user; // via ref_id relation

    /* ================= UPDATE USER ================= */
    $user->update([
        'name'           => $validated['full_name'],
        'contact_number' => $validated['contact_number'],
        'email'          => $validated['email'] ?? $user->email,
    ]);

    /* ================= UPDATE FOOD CATERING ================= */
    $foodCatering->update([
        'user_type'         => $validated['user_type'] ?? null,
        'full_name'         => $validated['full_name'],
        'gender'            => $validated['gender'] ?? null,
        'dob'               => $validated['dob'] ?? null,
        'whatsapp_number'   => $validated['whatsapp_number'] ?? null,
        'experience_years'  => $validated['experience_years'],
        'location'          => $validated['location'],
        'looking_for'       => $validated['looking_for'],
        'other_service'     => $validated['other_service'] ?? null,
        'add_require'       => $validated['add_require'] ?? null,
    ]);

    /* ================= REDIRECT ================= */
    if ($request->input('redirect')) {
        return redirect()
            ->route('admin.food-catering.index')
            ->with('success', 'Food Catering request updated successfully.');
    }

    return redirect()
        ->back()
        ->with('success', 'Food Catering request updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $id)
{
    $foodCatering = FoodCatering::findOrFail($id);

    // Soft delete if model uses SoftDeletes, otherwise hard delete
    $foodCatering->delete();

    return redirect()
        ->route('admin.food-catering.index')
        ->with('success', 'Food Catering record deleted successfully.');
}

}
