<?php

// common uses 
use Illuminate\Support\Facades\Route;

// website uses 
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\MailVerificationController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\AstroProductsController;
use App\Http\Controllers\MemberRoleConroller;



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

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;


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
Route::get('/register/match-making', [MatchMakingController::class, 'createF'])->name('match.making.create');
Route::post('/store/match-making', [MatchMakingController::class, 'store'])->name('match.making.store');

//Astrology
Route::post('/store/astrology', [AstrologyController::class, 'store'])->name('astrology.store');
Route::get('/register/astrology', [AstrologyController::class, 'createF'])->name('astrology.create');

// Mandap 
Route::get('/register/mandap', [MandapController::class, 'createF'])->name('mandap.create');
Route::post('/store/mandap', [MandapController::class, 'store'])->name('mandap.store');

// Pandit 
Route::get('/register/pandit', [PanditController::class, 'createF'])->name('pandit.create');
Route::post('/store/pandit', [PanditController::class, 'store'])->name('pandit.store');


// Food Catering 
Route::get('/register/food-catering', [FoodCateringController::class, 'createF'])->name('food.catering.create');
Route::post('/store/food-catering', [FoodCateringController::class, 'store'])->name('food.catering.store');


// Event Management admin.event.management.index
Route::get('/register/event-management', [EventManagementController::class, 'createF'])->name('event.management.create');
Route::post('/store/event-management', [EventManagementController::class, 'store'])->name('event.management.store');


// Karma Training 
Route::get('/register/karma-training', [KarmaTrainingController::class, 'createF'])->name('karma.training.create');
Route::post('/store/karma-training', [KarmaTrainingController::class, 'store'])->name('karma.training.store');

// Supoort  
Route::get('/register/support', [SupportController::class, 'createF'])->name('support.create');
Route::post('/store/support', [SupportController::class, 'store'])->name('support.store');


// Perform Kanyadan
Route::get('/register/perform-kanyadan', [PerformKanyadanController::class, 'create'])->name('perform.kanyadan.create');
Route::post('/store/perform-kanyadan', [PerformKanyadanController::class, 'store'])->name('perform.kanyadan.store');



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


Route::post('/buy/{productId}', [PaymentController::class, 'createOrder'])
    ->name('buy.create');


Route::post('/payment/verify', [PaymentController::class, 'verifyPayment'])
    ->name('payment.verify');

Route::get('/order-success/{order}', [PaymentController::class, 'success'])
    ->name('order.success');






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

        Route::resource('member-role', MemberRoleConroller::class);

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

        Route::resource('astrology', AstrologyController::class);

        Route::resource('mandap', MandapController::class);
         
        Route::resource('pandit', PanditController::class);

        Route::resource('food-catering', FoodCateringController::class);

        Route::resource('event-management', EventManagementController::class);

        Route::resource('karma-training', KarmaTrainingController::class);

        Route::resource('support', SupportController::class);

        Route::resource('perform-kanyadan', PerformKanyadanController::class);

        Route::resource('match-making', MatchMakingController::class);

        Route::get('/astro/orders', [OrderController::class, 'index'])->name('astro.product.order');


        
        


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


