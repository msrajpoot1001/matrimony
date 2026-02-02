<?php

// common uses 
use Illuminate\Support\Facades\Route;

// website uses 
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\MailVerificationController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\AstroProductsController;



//  Admin Use
use App\Http\Controllers\Admin\{
    MemberManagementController,
    ContentPagesController,
    CompanyInfoController,
    DashboardController,
    ProfileController,
    CkEditorController,
    MemberProfileController,
    PaymentGatewayController,
    SeoPageController,
    RecycleBinController,
    RegisterController,
    ContactController,
    FrontendContentController,
    HomeHeroContentController,
    KarmaTrainingContentController,
    HappyStoryController,
    PartnerController,
    CasteController,
    SubCasteController
};


use App\Http\Controllers\{
    MatchMakingController,
    AstrologyController,
    MandapController,
    PanditController,
    FoodCateringController,
    EventManagementController,
    KarmaTrainingController,
    SupportController,
    PerformKanyadanController,
    ServiceController,
   SubscriptionController,
  
};





// Frontend pages -> general pages
Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/contact-us', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact-store', [FrontendController::class, 'storeContact'])->name('contact.store');
Route::get('/about-us', [FrontendController::class, 'about'])->name('about');
Route::get('/blogs', [FrontendController::class, 'blogs'])->name('blogs');
Route::get('/karma-trainings', [FrontendController::class, 'karmaTrainings'])->name('karma.trainings');
Route::get('/karma-trainings-details/{slug}', [FrontendController::class, 'karmaDetail'])->name('karma.details');
Route::get('/astro-products', [FrontendController::class, 'astroProducts'])->name('astro.products');
Route::get('/astro-product-detail/{slug}', [FrontendController::class, 'astroProductDetail'])->name('astro.product.detail');
Route::get('/astro-buy-now/{slug}', [FrontendController::class, 'astroBuyNow'])->name('astro.buy.now');
Route::get('/service/match-making', [ServiceController::class, 'matchMaking'])->name('service.match.making');
Route::get('/membership', [FrontendController::class, 'membership'])->name('membership');

// Sub-caste AJAX fetch
Route::get('/get-sub-castes/{casteId}', [CasteController::class, 'getSubCastes'])
    ->name('get.sub-castes');


// Match Making 
Route::get('/register/match-making', [MatchMakingController::class, 'create'])->name('match.making.create');
Route::post('/store/match-making', [MatchMakingController::class, 'store'])->name('match.making.store');
Route::get('/admin/match-making', [MatchMakingController::class, 'index'])->name('admin.match.making.index');

//Astrology
Route::get('/register/astrology', [AstrologyController::class, 'create'])->name('astrology.create');
Route::get('/admin/register/astrology', [AstrologyController::class, 'adminCreate'])->name('admin.astrology.create');
Route::post('/store/astrology', [AstrologyController::class, 'store'])->name('astrology.store');
Route::get('/admin/astrology', [AstrologyController::class, 'index'])->name('admin.astrology.index');


// Mandap 
Route::get('/register/mandap', [MandapController::class, 'create'])->name('mandap.create');
Route::post('/store/mandap', [MandapController::class, 'store'])->name('mandap.store');
Route::get('/admin/mandap', [MandapController::class, 'index'])->name('admin.mandap.index');


// Pandit 
Route::get('/register/pandit', [PanditController::class, 'create'])->name('pandit.create');
Route::post('/store/pandit', [PanditController::class, 'store'])->name('pandit.store');
Route::get('/admin/pandit', [PanditController::class, 'index'])->name('admin.pandit.index');


// Food Catering 
Route::get('/register/food-catering', [FoodCateringController::class, 'create'])->name('food.catering.create');
Route::post('/store/food-catering', [FoodCateringController::class, 'store'])->name('food.catering.store');
Route::get('/admin/food-catering', [FoodCateringController::class, 'index'])->name('admin.food.catering.index');


// Event Management admin.event.management.index
Route::get('/register/event-management', [EventManagementController::class, 'create'])->name('event.management.create');
Route::post('/store/event-management', [EventManagementController::class, 'store'])->name('event.management.store');
Route::get('/admin/event-management', [EventManagementController::class, 'index'])->name('admin.event.management.index');


// Karma Training 
Route::get('/register/karma-training', [KarmaTrainingController::class, 'create'])->name('karma.training.create');
Route::post('/store/karma-training', [KarmaTrainingController::class, 'store'])->name('karma.training.store');
Route::get('/admin/karma-training', [KarmaTrainingController::class, 'index'])->name('admin.karma.training.index');


// Supoort  
Route::get('/register/support', [SupportController::class, 'create'])->name('support.create');
Route::post('/store/support', [SupportController::class, 'store'])->name('support.store');
Route::get('/admin/support', [SupportController::class, 'index'])->name('admin.support.index');


// Perform Kanyadan
Route::get('/register/perform-kanyadan', [PerformKanyadanController::class, 'create'])->name('perform.kanyadan.create');
Route::post('/store/perform-kanyadan', [PerformKanyadanController::class, 'store'])->name('perform.kanyadan.store');
Route::get('/admin/perform-kanyadan', [PerformKanyadanController::class, 'index'])->name('admin.perform.kanyadan.index');



// Frontend pages -> user content pages 
Route::get('/privacy-policy', [ContentPagesController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/cookie-policy', [ContentPagesController::class, 'CookiePolicy'])->name('cookie-policy');
Route::get('/terms-conditions', [ContentPagesController::class, 'TermsConditions'])->name('terms-conditions');


Route::post('/subscribe', [SubscriptionController::class, 'store'])
    ->name('subscribe.store');




// Auth Routes 
// login forgot password 
Route::get('/forgot-password-otp-index', [ForgotPasswordController::class, 'sendOtpIndex'])->name('send.otp.index');
Route::get('/request-email', [MailVerificationController::class, 'send'])->name('email.request.send');
Route::get('/verify-email/{user}', [MailVerificationController::class, 'verifyMail'])
    ->name('email.verify')
    ->middleware('signed');
    
// Show OTP verification form
Route::get('/verify-otp', [App\Http\Controllers\Auth\OtpController::class, 'showVerifyForm'])
    ->name('verify.otp');

// Submit OTP
Route::post('/verify-otp', [App\Http\Controllers\Auth\OtpController::class, 'verifyOtp'])
    ->name('verify.otp.post');






Route::middleware(['auth'])->group(function () {

}); 





Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::resource('dashboard', DashboardController::class)
        ->only(['index']);


        // Users
        Route::resource('members', MemberManagementController::class)
            ->only(['index', 'edit', 'update']);

        Route::get('/member-profile/{user?}', [MemberManagementController::class, 'memberProfile'])
            ->name('member-profile');

        // index
        Route::get('/content-pages', [ContentPagesController::class, 'index'])
            ->name('content-pages.index');

        // edit
        Route::get('/content-pages/{content_page}/edit', [ContentPagesController::class, 'edit'])
            ->name('content-pages.edit');

        // update
        Route::put('/content-pages/{content_page}', [ContentPagesController::class, 'update'])
            ->name('content-pages.update');



        Route::get('/company-info/edit', [CompanyInfoController::class, 'edit'])
            ->name('company-info.edit');

        Route::post('/company-info', [CompanyInfoController::class, 'update'])
            ->name('company-info.update');

        // Profile (admin user’s own profile)
        Route::controller(ProfileController::class)->group(function () {
            Route::get('/profile', 'edit')->name('profile.edit');
            Route::patch('/profile', 'update')->name('profile.update');
            Route::delete('/profile', 'destroy')->name('profile.destroy');
        });

        // CKEditor uploads
        Route::controller(CkEditorController::class)->group(function () {
            Route::post('/ckeditor/upload-image', 'uploadCKEditorImage')->name('ckeditor.upload-image');
            Route::post('/ckeditor/delete-image', 'deleteCKEditorImage')->name('ckeditor.delete-image');
        });

        // User profile pages (admin-managed)
        Route::controller(UserProfileController::class)->group(function () {
            Route::get('/user-profile', 'user_profile')->name('user-profile.show');
            Route::get('/user-profile/edit', 'user_profile_edit')->name('user-profile.edit');
            Route::post('/user-profile', 'user_profile_update')->name('user-profile.update');
        });

        Route::resource('/payment-gateway', PaymentGatewayController::class)
            ->middleware('verified')
            ->names('payment-gateway');

        Route::resource('/seo-pages', SeoPageController::class)
            ->middleware('verified')
            ->names('seo-pages');

        // Recycle Bin
        Route::controller(RecycleBinController::class)->prefix('recycle-bin')->group(function () {
            Route::get('/', 'index')->name('recyclebin.index');
            Route::post('/restore', 'restore')->name('recyclebin.restore');
            Route::delete('/force-delete', 'forceDelete')->name('recyclebin.forceDelete');
        });


        Route::get('/contact-records', [ContactController::class, 'contactRecords'])
            ->name('contact.records');
        Route::get('/query-records', [ContactController::class, 'queryRecords'])
            ->name('query.records');
        Route::delete('/delete-contact', [ContactController::class, 'delteContact'])
            ->name('delete.contact');

        Route::get('/subscription', [SubscriptionController::class, 'index'])
            ->name('subscription.index');
        Route::delete('/subscriptions/{id}', [SubscriptionController::class, 'destroy'])
            ->name('subscriptions.destroy');
        Route::put('/subscriptions/{id}', [SubscriptionController::class, 'update'])
        ->name('subscriptions.update');

    
    

        Route::resource('hero-contents', HomeHeroContentController::class)
            ->except(['show', 'create']);

         Route::resource(
            'karma-training-content',
            KarmaTrainingContentController::class
        )->except(['show']);  

        Route::resource(
            'frontend-content',
            FrontendContentController::class
        )->except(['show', 'create']);

        // AdvertisementController
        Route::resource('advertisement', AdvertisementController::class);

        // AstroProductsController
        Route::resource('astro-products', AstroProductsController::class);

        
        // HappyStoryController
        Route::resource('happy-story', HappyStoryController::class);

        // PartnerController
        Route::resource('partner', PartnerController::class);

        // CasteController
        Route::resource('caste', CasteController::class);
        
        // SubCasteController
        Route::resource('sub-caste', SubCasteController::class);

    });





// default routes 

// 404 not found page 
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

// unauthorized routes 
Route::get('/403-unauthorized', function () {
    return view('errors.403_unauthorized');
})->name('403_unauthorized');



require __DIR__.'/auth.php';


