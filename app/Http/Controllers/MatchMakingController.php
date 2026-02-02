<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\MatchMaking;
use App\Models\SubCaste;
use App\Models\Caste;
class MatchMakingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    
        $matchMakings = MatchMaking::latest()->paginate(20);
        return view('dashboard.pages.admin.register.match-making', compact('matchMakings'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
           $caste=Caste::latest()->get();
        return view('website.pages.register.match-making',compact('caste'));
    }

    /**
     * Store a newly created resource in storage.
     */

public function store(Request $request)
{
    // ✅ VALIDATION (MATCHES FINAL FORM)
    $validated = $request->validate([

        /* ================= BASIC DETAILS ================= */
        'looking_for'            => 'required|in:Bride,Groom',
        'candidate_name'         => 'required|string|max:255',
        'email'                  => 'nullable|email|max:255',
        'gender'                 => 'required|in:Male,Female,Other',
        'dob'                    => 'required|date',
       'height' => 'nullable|numeric|min:3|max:8',
        'contact_number'         => 'required|string|max:20',
        'whatsapp_number'        => 'nullable|string|max:20',

        /* ================= PERSONAL & RELIGION ================= */
        'marital_status'         => 'required|string|max:50',
        'religion'               => 'required|string|max:50',
        'caste'                  => 'required|string|max:100',
        'sub_caste'              => 'nullable|string|max:100',
        'manglik_status'         => 'nullable|in:Yes,No,Don\'t Know',
        'interest_inter_caste'   => 'nullable|in:Yes,No',

        /* ================= PROFESSIONAL ================= */
        'qualification'          => 'required|string|max:255',
        'company_name'           => 'nullable|string|max:255',
        'designation'            => 'nullable|string|max:255',
        'place_of_work'          => 'nullable|string|max:255',
        'year_of_experience' => 'nullable|numeric|min:0|max:60',
        'employment_status'      => 'required|in:Working,Not Working',
        'annual_income'          => 'nullable|string|max:50',

        /* ================= FAMILY ================= */
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

        /* ================= HOROSCOPE ================= */
        'birth_place'            => 'required|string|max:255',
        'birth_time'             => 'nullable',
        'kundali_details'        => 'nullable|string',

        /* ================= FILE UPLOADS ================= */
        'full_photo'             => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        'govt_id_proof'          => 'nullable|file|mimes:jpg,jpeg,png,pdf,webp|max:2048',
        'kundali'                => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096',
    ]);

    /* ================= FILE UPLOADS ================= */

    // ✅ Full Photo
    if ($request->hasFile('full_photo')) {
        $photo      = $request->file('full_photo');
        $photoName  = time().'_'.Str::random(10).'.'.$photo->getClientOriginalExtension();
        $photoPath  = 'upload/match-making/full-photo';

        $photo->move(public_path($photoPath), $photoName);
        $validated['full_photo'] = $photoPath.'/'.$photoName;
    }

    // ✅ Govt ID Proof
    if ($request->hasFile('govt_id_proof')) {
        $idFile     = $request->file('govt_id_proof');
        $idName     = time().'_'.Str::random(10).'.'.$idFile->getClientOriginalExtension();
        $idPath     = 'upload/match-making/govt-id';

        $idFile->move(public_path($idPath), $idName);
        $validated['govt_id_proof'] = $idPath.'/'.$idName;
    }

    // ✅ Kundali Upload
    if ($request->hasFile('kundali')) {
        $kundali    = $request->file('kundali');
        $kName      = time().'_'.Str::random(10).'.'.$kundali->getClientOriginalExtension();
        $kPath      = 'upload/match-making/kundali';

        $kundali->move(public_path($kPath), $kName);
        $validated['kundali'] = $kPath.'/'.$kName;
    }

    /* ================= SAVE ================= */
    MatchMaking::create($validated);

    return redirect()
        ->back()
        ->with('success', 'Match Making profile submitted successfully.');
}


}
