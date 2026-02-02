<?php
namespace App\Http\Controllers\Admin;
 use Illuminate\Http\Request;
 use App\Models\ContentPagesContent;
 use App\Http\Controllers\Controller;  
 class ContentPagesController extends Controller
 {
 
     public function privacyPolicy()
     {   
        $item=ContentPagesContent::where('type','privacy_policy')->first();
         return view('website.pages.content-page.privacy-policy',compact('item'));
     }

     public function cookiePolicy()
     {   
        $item=ContentPagesContent::where('type','cookie_policy')->first();
         return view('website.pages.content-page.cookie-policy',compact('item'));
     }

     public function termsConditions()
     {   
        $item=ContentPagesContent::where('type','terms_conditions')->first();
         return view('website.pages.content-page.terms-conditions',compact('item'));
     }

    
     public function index()
     {
        $contentPagesContents = ContentPagesContent::orderBy('created_at', 'desc')->get();
        return view('dashboard.pages.admin.content-pages.content-pages', compact('contentPagesContents'));
 
     }
 
    
     
     public function edit(string $id)
 {
    
     // Fetch the blog by ID or fail with 404 if not found
     $contentPage = ContentPagesContent::findOrFail($id);
     $pageName="";
     if($contentPage->type==='privacy_policy'){
        $pageName="Privacy Policy";
     }else if($contentPage->type==='cookie_policy'){
        $pageName="Privacy Policy";
     }else{
        $pageName="Terms & Conditions";
     }
     return view('dashboard.pages.admin.content-pages.content-pages-edit', compact('contentPage','pageName'));
 }
 
 
     /**
      * Update the specified resource in storage.
      */
     
      public function update(Request $request, $id)
      {
          $content = ContentPagesContent::findOrFail($id);
      
          $request->validate([
              'type'     => 'required|string|max:255',
              'heading' => 'required|string|max:255',
              'description'     => 'required|string',
          ]);
      
          $data = $request->only([
              'type',
              'heading',
              'description'
          ]);
      
         
      
          // Update testimonial
          $content->update($data);
      
          return redirect()->route('admin.content-pages.index')->with('success', 'Testimonial updated successfully!');
      }
 }
 