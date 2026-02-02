<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CompanyInfo;
use App\Models\Contact;
use App\Models\HomeHeroContent;
use App\Models\KarmaTrainingContent;
use App\Models\FrontendContent;
use App\Models\Advertisement;
use App\Models\AstroProducts;
use App\Models\HappyStory;
use App\Models\Partner;
use App\Models\Caste;



class FrontendController extends Controller
{
     public function home(){
      $home_hero=HomeHeroContent::latest()->get();
      $karma_content = KarmaTrainingContent::latest()->take(3)->get()->map(function ($item) {
      $item->short_description = Str::words(strip_tags($item->short_description), 20);
      return $item;
      });
       $astro_products = AstroProducts::latest()->take(20)->get()->map(function ($item) {
      $item->short_description = Str::words(strip_tags($item->short_description), 10);
      return $item;
      });
      $adv=Advertisement::latest()->get();
      $frontend_content=FrontendContent::latest()->first();
      $happy_stories=HappyStory::latest()->get();
      
      $frontend_content=FrontendContent::first();
      $caste=Caste::latest()->get();
      
    return view('website.pages.home',compact('home_hero','karma_content','frontend_content','adv','astro_products','happy_stories','frontend_content','caste'));
   }

   public function contact(){
      $company=Companyinfo::first();
      return view('website.pages.contact',compact('company'));
   }

   public function storeContact(Request $request)
   {

      $validated = $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'nullable|email|max:255',
        'phone'   => 'required|string|max:20',
        'subject' => 'nullable|string|max:255',
        'message' => 'required|string',
        'type'=>'required|string',
      ]);

      Contact::create($validated);

      return back()->with('success', 'Your message has been sent successfully!')->with('contact_success','true');
   }

 

   

    public function about(){
      
       $frontend_content=FrontendContent::first();
       $company=Companyinfo::first();
       $partners =Partner::latest()->where('is_active',1)->get();
       
    return view('website.pages.about',compact('company','partners','frontend_content'));
   }
   


   public function blogs(){
    return view('website.pages.blogs');
   }

   public function karmaDetail($slug){
      $karma_detail=KarmaTrainingContent::where('slug',$slug)->first();
      $items=KarmaTrainingContent::where('slug','!=', $slug)->where('is_active',1)->latest()->limit(5)->get();
      return view("website.pages.karma-details",compact('karma_detail','items'));
   }



public function karmaTrainings()
{
    $items = KarmaTrainingContent::latest()
        ->paginate(6) // number per page
        ->through(function ($item) {
            $item->short_description = Str::words(strip_tags($item->short_description), 20);
            return $item;
        });

    return view('website.pages.karma-training', compact('items'));
}



public function astroProducts()
{
    $items = AstroProducts::latest()
        ->paginate(8); // items per page

    $items->getCollection()->transform(function ($item) {
        $item->short_description = Str::words(strip_tags($item->short_description), 10);
        return $item;
    });

    return view('website.pages.astro-products', compact('items'));
}



   public function astroProductDetail($slug){
      $astro_products_detail=AstroProducts::where('slug',$slug)->first();
      $items=AstroProducts::where('slug','!=', $slug)->where('is_active',1)->latest()->limit(5)->get();
      return view("website.pages.astro-product-details",compact('astro_products_detail','items'));
   }

   

    public function astroBuyNow($slug){
      $product=AstroProducts::where('slug',$slug)->first();
      return view("website.pages.astro-buy-now",compact('product'));
   }

   public function membership(){
      return view("website.pages.membership");
   }




    
}
