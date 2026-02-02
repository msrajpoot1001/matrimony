<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {

        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
{
    // Find user by email
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->with('error', 'No user found with this email.');
    }

    // Check if email is verified
    // if ($user->email_verified_at === null) {
    //     return back()->with('error', 'Please verify your email first.');
    // }

    // Authenticate user (password check)
    $request->authenticate();
    $request->session()->regenerate();

    // Generate device token using IP + user agent
    $deviceToken = hash('sha256', request()->ip() . request()->userAgent());

    // Check if device exists for this user
    // $deviceExists = \DB::table('user_devices')
    //     ->where('user_id', $user->id)
    //     ->where('device_token', $deviceToken)
    //     ->exists();

    // if (!$deviceExists) {
    //     // New device detected → generate OTP
    //     $otp = rand(100000, 999999);

    //     // Store OTP in database (create user_otps table first)
    //     \DB::table('user_otps')->insert([
    //         'user_id' => $user->id,
    //         'device_token' => $deviceToken,
    //         'otp' => $otp,
    //         'expires_at' => now()->addMinutes(10), // OTP valid for 10 minutes
    //         'created_at' => now(),
    //         'updated_at' => now(),
    //     ]);

    //     // Send OTP via email
    //     \Mail::to($user->email)->send(new \App\Mail\OtpMail($otp));

    //     // Logout temporarily until OTP verification
    //     Auth::logout();

    //     return redirect()->route('verify.otp')
    //         ->with('success', 'OTP sent to your email. Please verify to continue.');
    // }

    // Existing device → normal login
    $request->session()->flash('success', 'Successfully logged in!');
    return redirect()->intended(route('admin.dashboard.index', absolute: false));
}



    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
