<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    public function showVerifyForm()
    {
        return view('auth.verify-otp'); // Create this Blade view
    }

   public function verifyOtp(Request $request)
{
    // Validate OTP input
    $request->validate([
        'otp' => 'required|numeric'
    ]);

    $user = null;
    $deviceToken = hash('sha256', request()->ip() . request()->userAgent());

    // Find OTP record in the database
    $otpRecord = \DB::table('user_otps')
        ->where('device_token', $deviceToken)
        ->where('otp', $request->otp)
        ->where('expires_at', '>', now())
        ->first();

    if (!$otpRecord) {
        return back()->withErrors(['otp' => 'Invalid or expired OTP']);
    }

    // OTP is valid → fetch the user
    $user = \App\Models\User::find($otpRecord->user_id);

    if (!$user) {
        return redirect()->route('login')->with('error', 'User not found.');
    }

    // Log in the user
    Auth::login($user);

    // Save device for future logins
    \DB::table('user_devices')->updateOrInsert(
        [
            'user_id' => $user->id,
            'device_token' => $deviceToken,
        ],
        [
            'ip_address' => request()->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]
    );

    // Delete OTP record after verification
    \DB::table('user_otps')->where('id', $otpRecord->id)->delete();

    return redirect()->intended(route('admin.dashboard.index'))->with('success', 'Device verified and logged in successfully!');
}

}

