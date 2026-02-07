<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\MatchMaking;
use App\Models\SubCaste;
use App\Models\Caste;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MatchMakingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matchMakings = MatchMaking::with(with(['caste', 'subCaste','user']))->latest()->paginate(20);
        return view('dashboard.pages.admin.main-services.match-making.index', compact('matchMakings'));
    }

    public function create()
    {
         $caste=Caste::latest()->get();
           $subCastes=[];
        return view('dashboard.pages.admin.main-services.match-making.create',compact('caste','subCastes'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function createF()
    {
           $caste=Caste::latest()->get();
           $subCastes=[];
        return view('website.pages.register.match-making',compact('caste','subCastes'));
    }

    /**
     * Store a newly created resource in storage.
     */


public function store(Request $request)
{
    
    /* ================= VALIDATION ================= */
    $validated = $request->validate([

        /* BASIC DETAILS */
        'looking_for'            => 'required|in:Bride,Groom',
        'candidate_name'         => 'required|string|max:255',
        'email'                  => 'required|email|max:255',
        'gender'                 => 'required|in:Male,Female,Other',
        'dob'                    => 'required|date',
        'height'                 => 'nullable|numeric|min:3|max:8',
        'contact_number'         => 'required|string|max:20',
        'whatsapp_number'        => 'nullable|string|max:20',

        /* PERSONAL & RELIGION */
        'marital_status'         => 'required|string|max:50',
        'religion'               => 'required|string|max:50',
        'caste_id'                  => 'required|string|max:100',
        'sub_caste_id'              => 'nullable|string|max:100',
        'manglik_status'         => 'nullable|in:Yes,No,Don\'t Know',
        'interest_inter_caste'   => 'nullable|in:Yes,No',

        /* PROFESSIONAL */
        'qualification'          => 'required|string|max:255',
        'company_name'           => 'nullable|string|max:255',
        'designation'            => 'nullable|string|max:255',
        'place_of_work'          => 'nullable|string|max:255',
        'year_of_experience'     => 'nullable|numeric|min:0|max:60',
        'employment_status'      => 'required|in:Working,Not Working',
        'annual_income'          => 'nullable|string|max:50',

        /* FAMILY */
        'father_name'            => 'required|string|max:255',
        'father_occupation'      => 'required|string|max:255',
        'mother_name'            => 'required|string|max:255',
        'mother_occupation'      => 'required|string|max:255',
        'family_income'          => 'nullable|string|max:50',
        'family_status'          => 'required|in:Middle Class,Upper Middle Class,Rich and Affluent',
        'family_values'          => 'required|in:Orthodox,Modern,Liberal,Spiritually Inclined',
        'living_with_family'     => 'required|in:Yes,No',
        'living_at'              => 'nullable|string|max:255',
        'ancestral_origin'       => 'nullable|string|max:255',

        /* HOROSCOPE */
        'birth_place'            => 'required|string|max:255',
        'birth_time'             => 'nullable',
        'kundali_details'        => 'nullable|string',

        /* FILES */
        'full_photo'             => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        'govt_id_proof'          => 'nullable|file|mimes:jpg,jpeg,png,pdf,webp|max:2048',
        'kundali'                => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096',
    ]);


    /* ================= CREATE / FETCH USER ================= */
    $user = User::firstOrCreate(
        ['email' => $validated['email']], // search
        [
            'name'           => $validated['candidate_name'],
            'contact_number' => $validated['contact_number'],
            'password'       => Hash::make(Str::random(12)),
        ]
    );


     /* ================= CHECK ALREADY REGISTERED ================= */
    $astro = MatchMaking::where('ref_id', $user->id)->first();

    if ($astro) {
        return redirect()
            ->back()
            ->with('error', 'You are already registered for this match making service. Please Login');
    }

    /* ================= FILE UPLOADS ================= */
    if ($request->hasFile('full_photo')) {
        $photoName = time().'_'.Str::random(10).'.'.$request->full_photo->extension();
        $path = 'upload/match-making/full-photo';
        $request->full_photo->move(public_path($path), $photoName);
        $validated['full_photo'] = $path.'/'.$photoName;
    }

    if ($request->hasFile('govt_id_proof')) {
        $idName = time().'_'.Str::random(10).'.'.$request->govt_id_proof->extension();
        $path = 'upload/match-making/govt-id';
        $request->govt_id_proof->move(public_path($path), $idName);
        $validated['govt_id_proof'] = $path.'/'.$idName;
    }

    if ($request->hasFile('kundali')) {
        $kName = time().'_'.Str::random(10).'.'.$request->kundali->extension();
        $path = 'upload/match-making/kundali';
        $request->kundali->move(public_path($path), $kName);
        $validated['kundali'] = $path.'/'.$kName;
    }

    /* ================= SAVE MATCH MAKING ================= */
    $validated['ref_id'] = $user->id;

    MatchMaking::create($validated);

   if($request->input('redirect')){
        return redirect()
        ->route('admin.match-making.index')
        ->with('success', 'Match Making request submitted successfully.');
    }else{
        return redirect()
        ->back()
        ->with('success', 'Match Making request submitted successfully.');
    }

}


  public function edit(string $id)
{
    $item = MatchMaking::with('user')->findOrFail($id);
      $caste=Caste::latest()->get();
       $subCastes=SubCaste::latest()->get();

    return view(
        'dashboard.pages.admin.main-services.match-making.edit',
        compact('item','caste','subCastes')
    );
}


public function update(Request $request, string $id)
{
    /* ================= FIND RECORD ================= */
    $item = MatchMaking::findOrFail($id);

    /* ================= VALIDATION ================= */
    $validated = $request->validate([

        /* BASIC DETAILS */
        'looking_for'            => 'required|in:Bride,Groom',
        'candidate_name'         => 'required|string|max:255',
        'email'                  => 'required|email|max:255',
        'gender'                 => 'required|in:Male,Female,Other',
        'dob'                    => 'required|date',
        'height'                 => 'nullable|numeric|min:3|max:8',
        'contact_number'         => 'required|string|max:20',
        'whatsapp_number'        => 'nullable|string|max:20',

        /* PERSONAL & RELIGION */
        'marital_status'         => 'required|string|max:50',
        'religion'               => 'required|string|max:50',
        'caste_id'                  => 'required|string|max:100',
        'sub_caste_id'              => 'nullable|string|max:100',
        'manglik_status'         => 'nullable|in:Yes,No,Don\'t Know',
        'interest_inter_caste'   => 'nullable|in:Yes,No',

        /* PROFESSIONAL */
        'qualification'          => 'required|string|max:255',
        'company_name'           => 'nullable|string|max:255',
        'designation'            => 'nullable|string|max:255',
        'place_of_work'          => 'nullable|string|max:255',
        'year_of_experience'     => 'nullable|numeric|min:0|max:60',
        'employment_status'      => 'required|in:Working,Not Working',
        'annual_income'          => 'nullable|string|max:50',

        /* FAMILY */
        'father_name'            => 'required|string|max:255',
        'father_occupation'      => 'required|string|max:255',
        'mother_name'            => 'required|string|max:255',
        'mother_occupation'      => 'required|string|max:255',
        'family_income'          => 'nullable|string|max:50',
        'family_status'          => 'required|in:Middle Class,Upper Middle Class,Rich and Affluent',
        'family_values'          => 'required|in:Orthodox,Modern,Liberal,Spiritually Inclined',
        'living_with_family'     => 'required|in:Yes,No',
        'living_at'              => 'nullable|string|max:255',
        'ancestral_origin'       => 'nullable|string|max:255',

        /* HOROSCOPE */
        'birth_place'            => 'required|string|max:255',
        'birth_time'             => 'nullable',
        'kundali_details'        => 'nullable|string',

        /* FILES (OPTIONAL IN UPDATE) */
        'full_photo'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'govt_id_proof'          => 'nullable|file|mimes:jpg,jpeg,png,pdf,webp|max:2048',
        'kundali'                => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096',
    ]);

    /* ================= UPDATE USER INFO ================= */
    $user = User::find($item->ref_id);

    if ($user) {
        $user->update([
            'name'           => $validated['candidate_name'],
            'contact_number' => $validated['contact_number'],
            'email'          => $validated['email'],
        ]);
    }

    /* ================= FILE UPDATES ================= */

    if ($request->hasFile('full_photo')) {
        if ($item->full_photo && file_exists(public_path($item->full_photo))) {
            unlink(public_path($item->full_photo));
        }

        $photoName = time().'_'.Str::random(10).'.'.$request->full_photo->extension();
        $path = 'upload/match-making/full-photo';
        $request->full_photo->move(public_path($path), $photoName);
        $validated['full_photo'] = $path.'/'.$photoName;
    }

    if ($request->hasFile('govt_id_proof')) {
        if ($item->govt_id_proof && file_exists(public_path($item->govt_id_proof))) {
            unlink(public_path($item->govt_id_proof));
        }

        $idName = time().'_'.Str::random(10).'.'.$request->govt_id_proof->extension();
        $path = 'upload/match-making/govt-id';
        $request->govt_id_proof->move(public_path($path), $idName);
        $validated['govt_id_proof'] = $path.'/'.$idName;
    }

    if ($request->hasFile('kundali')) {
        if ($item->kundali && file_exists(public_path($item->kundali))) {
            unlink(public_path($item->kundali));
        }

        $kName = time().'_'.Str::random(10).'.'.$request->kundali->extension();
        $path = 'upload/match-making/kundali';
        $request->kundali->move(public_path($path), $kName);
        $validated['kundali'] = $path.'/'.$kName;
    }

    /* ================= UPDATE MATCH MAKING ================= */
    $item->update($validated);

    /* ================= REDIRECT ================= */
    if ($request->input('redirect')) {
        return redirect()
            ->route('admin.match-making.index')
            ->with('success', 'Match making details updated successfully.');
    }

    return redirect()
        ->back()
        ->with('success', 'Match making details updated successfully.');
}



   public function destroy($id)
{
    $astro = MatchMaking::findOrFail($id);

    $astro->delete();
   

    return redirect()
        ->route("admin.match-making.index")
        ->with('success', 'Match Making profile deleted successfully.');
}



}
