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
        $events = EventManagement::with('user')->latest()->paginate(20);
        return view('dashboard.pages.admin.main-services.event-management.index', compact('events'));
    }

    public function create()
    {
        return view('dashboard.pages.admin.main-services.event-management.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createF()
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

     /* ================= CHECK ALREADY REGISTERED ================= */
    $e_mange = EventManagement::where('ref_id', $user->id)->first();

    if ($e_mange) {
        return redirect()
            ->back()
            ->with('error', 'You are already registered for this Event Managemnet service. Please Login');
    }

    /* ================= SAVE EVENT MANAGEMENT ================= */
    EventManagement::create([
        'ref_id'            => $user->id, // ✅ REQUIRED
        'user_type'         => $validated['user_type'] ?? null,
        'full_name'         => $validated['full_name'],
        'gender'            => $validated['gender'],
        'dob'               => $validated['dob'],
        'whatsapp_number'   => $validated['whatsapp_number'] ?? null,
        'experience_years'  => $validated['experience_years'] ?? null,
        'location'          => $validated['location'],
        'services_offered'  => $validated['services_offered'],
        'other_service'     => $validated['other_service'] ?? null,
        'add_require'       => $validated['add_require'] ?? null,
    ]);

  if($request->input('redirect')){
        return redirect()
        ->route('admin.event-management.index')
        ->with('success', 'Event Management request submitted successfully.');
    }else{
        return redirect()
        ->back()
        ->with('success', 'Event Management request submitted successfully.');
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
    $item = EventManagement::with('user')->findOrFail($id);

    return view(
        'dashboard.pages.admin.main-services.event-management.edit',
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

    /* ================= FETCH EVENT MANAGEMENT ================= */
    $event = EventManagement::findOrFail($id);

    /* ================= UPDATE / FETCH USER ================= */
    $user = User::updateOrCreate(
        ['id' => $event->ref_id],   // 🔗 linked user
        [
            'name'           => $validated['full_name'],
            'email'          => $validated['email'],
            'contact_number' => $validated['contact_number'],
        ]
    );

    /* ================= UPDATE EVENT MANAGEMENT ================= */
    $event->update([
        'user_type'         => $validated['user_type'] ?? null,
        'full_name'         => $validated['full_name'],
        'gender'            => $validated['gender'],
        'dob'               => $validated['dob'],
        'whatsapp_number'   => $validated['whatsapp_number'] ?? null,
        'experience_years'  => $validated['experience_years'] ?? null,
        'location'          => $validated['location'],
        'services_offered'  => $validated['services_offered'],
        'other_service'     => $validated['other_service'] ?? null,
        'add_require'       => $validated['add_require'] ?? null,
    ]);

    /* ================= REDIRECT ================= */
    if ($request->input('redirect')) {
        return redirect()
            ->route('admin.event-management.index')
            ->with('success', 'Event Management record updated successfully.');
    }

    return redirect()
        ->back()
        ->with('success', 'Event Management record updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $id)
{
    $event = EventManagement::findOrFail($id);

    // Delete event management record
    $event->delete();

    return redirect()
        ->route('admin.event-management.index')
        ->with('success', 'Event Management record deleted successfully.');
}

}
