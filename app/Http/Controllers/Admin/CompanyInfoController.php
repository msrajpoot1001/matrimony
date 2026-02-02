<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;   

use App\Models\CompanyInfo;

class CompanyInfoController extends Controller
{
    
   public function edit()
   {

       $companyinfos = CompanyInfo::first();
        return view('admin::company-info.company-info', compact('companyinfos'));   
    }
    
    

public function update(Request $request)
{

   
   // ✅ Step 1: Validate inputs
    $request->validate([
    'company_name'   => 'nullable|string|max:255',
    'client_name'    => 'nullable|string|max:255',
    'title'          => 'nullable|string|max:255',
    'description'    => 'nullable|string|max:1000',

    // Emails
    'email1'         => 'nullable|email|max:255',
    'email2'         => 'nullable|email|max:255',
    'email3'         => 'nullable|email|max:255',

    // Phones
    'phone1'         => 'nullable|string|regex:/^[0-9+\-\s()]{7,20}$/|max:20',
    'phone2'         => 'nullable|string|regex:/^[0-9+\-\s()]{7,20}$/|max:20',
    'phone3'         => 'nullable|string|regex:/^[0-9+\-\s()]{7,20}$/|max:20',

    // Addresses
    'address1'       => 'nullable|string|max:500',
    'address2'       => 'nullable|string|max:500',
    'address3'       => 'nullable|string|max:500',

    // Social links
    'facebook'       => 'nullable|url|max:255',
    'instagram'      => 'nullable|url|max:255',
    'twitter'        => 'nullable|url|max:255',
    'youtube'        => 'nullable|url|max:255',
    'linkedin'       => 'nullable|url|max:255',
    'pinterest'      => 'nullable|url|max:255',

    // Website
    'website_url'    => 'nullable|url|max:255',
    'google_map_location'    => 'nullable|string|max:500',
    'google_map_link'    => 'nullable|string|max:500',
    

    // Files
    'logo'           => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    'favicon'        => 'nullable|mimes:png,ico,svg|max:1024',
    'brochure'       => 'nullable|mimes:pdf|max:5120',

    // Status fields
    'status_logo'    => 'nullable|in:0,1',
    'status_favicon' => 'nullable|in:0,1',
    'status_brochure'=> 'nullable|in:0,1',
    ]);



    // ✅ Step 2: Get or create the company record
    $company = CompanyInfo::first() ?? new CompanyInfo;




    $aboutPdfField = 'brochure';
    if ($request->hasFile($aboutPdfField)) {
        if (!empty($company->$aboutPdfField) && file_exists(public_path($company->$aboutPdfField))) {
            unlink(public_path($company->$aboutPdfField));
        }

        $folder = 'upload/brochure';
        $path = public_path($folder);

        // dd($path);
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file($aboutPdfField);
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($path, $filename);

        $fullPath = $path . '/' . $filename;

        //   dd($folder . '/' . $filename);

        $company->brochure = $folder . '/' . $filename;

    } elseif ($request->input('status_brochure') === '0') {
        if (!empty($company->brochure) && file_exists(public_path($company->brochure))) {
            unlink(public_path($company->brochure));
        }
        $company->brochure = null;
    }


    // ✅ Step 3: Handle logo upload
    $logoField = 'logo';
    if ($request->hasFile($logoField)) {
        if (!empty($company->$logoField) && file_exists(public_path($company->$logoField))) {
            unlink(public_path($company->$logoField));
        }

        $folder = 'upload/logo';
        $path = public_path($folder);
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file($logoField);
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($path, $filename);
        

        $company->$logoField = $folder . '/' . $filename;

    } elseif ($request->input('status_logo') === '0') {
        if (!empty($company->$logoField) && file_exists(public_path($company->$logoField))) {
            unlink(public_path($company->$logoField));
        }
        $company->$logoField = null;
    }


    // ✅ Step 4: Handle favicon upload
    $faviconField = 'favicon';
    if ($request->hasFile($faviconField)) {
        if (!empty($company->$faviconField) && file_exists(public_path($company->$faviconField))) {
            unlink(public_path($company->$faviconField));
        }

        $folder = 'upload/favicon';
        $path = public_path($folder);
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file($faviconField);
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($path, $filename);

        $company->$faviconField = $folder . '/' . $filename;

    } elseif ($request->input('status_favicon') === '0') {
        if (!empty($company->$faviconField) && file_exists(public_path($company->$faviconField))) {
            unlink(public_path($company->$faviconField));
        }
        $company->$faviconField = null;
    }

   // ✅ Step 5: Update other fields
    $company->company_name  = $request->input('company_name');
    $company->client_name   = $request->input('client_name');

    $company->email1         = $request->input('email1');
    $company->email2         = $request->input('email2');
    $company->email3         = $request->input('email3');

    $company->title         = $request->input('title');
    $company->description   = $request->input('description');

    $company->phone1         = $request->input('phone1');
    $company->phone2        = $request->input('phone2');
    $company->phone3        = $request->input('phone3');

    $company->address1       = $request->input('address1');
    $company->address2       = $request->input('address2');
    $company->address3       = $request->input('address3');

    $company->facebook      = $request->input('facebook');
    $company->instagram     = $request->input('instagram');
    $company->twitter       = $request->input('twitter');
    $company->youtube       = $request->input('youtube');
    $company->linkedin      = $request->input('linkedin');
    $company->pinterest     = $request->input('pinterest');

    $company->website_url   = $request->input('website_url'); // ✅ added
    $company->google_map_location   = $request->input('google_map_location');
    $company->google_map_link   = $request->input('google_map_link');
    


    // ✅ Step 6: Save and redirect
    $company->save();

    return redirect()->route('admin.dashboard.index')->with('message', 'Company information saved successfully!');
}

    
 }
