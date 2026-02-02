<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserProfile;
use App\Models\Address;
use App\Models\User;
use App\Http\Controllers\Controller;  


class MemberProfileController extends Controller
{
      
    public function user_profile()
    {
        
         $user = Auth::user();

    // Get main address
    $address_main = $user->addresses()->where('type', 'main')->first();

    // Get user profile
    $user_profile = $user->profile()->first();
    

    return view('admin::user-management.users', compact('address_main', 'user_profile', 'user'));

    }
    
    public function user_profile_edit()
{
    $user = Auth::user();

    // Get main address
    $address_main = $user->addresses()->where('type', 'main')->first();

    // Get user profile
    $user_profile = $user->profile()->first();

    return view('user_profile.user_profile_edit', compact('address_main', 'user_profile', 'user'));
}

      
      
  public function user_profile_update(Request $request)
{
    $user = Auth::user();

    // Validate request
    $request->validate([
        'name'        => 'required|string|max:20',
        'phone'        => 'required|string|max:20',
        'street'       => 'required|string|max:255',
        'landmark'     => 'nullable|string|max:255',
        'city'         => 'required|string|max:100',
        'state'        => 'required|string|max:100',
        'country'      => 'required|string|max:100',
        'postal_code'  => 'required|string|max:20',
        'education'        => 'required|string|max:30',
    ]);

    // 1️⃣ Update or Create User Profile
    UserProfile::updateOrCreate(
        ['user_id' => $user->id],
        [
            'education'    => $request->education,
        ]
    );

    // 2️⃣ Handle Addresses Table
    $existingMainAddress = $user->addresses()->where('type', 'main')->first();
    
    
     $user->update([
        'name' => $request->name,
    ]);

    if ($existingMainAddress) {
        // Update existing main address
        $existingMainAddress->update([
              'name'       => $request->name,
            'phone'       => $request->phone,
            'street'      => $request->street,
            'landmark'    => $request->landmark,
            'city'        => $request->city,
            'state'       => $request->state,
            'country'     => $request->country,
            'postal_code' => $request->postal_code,
        ]);
    } else {
        // No main address found → create main and default addresses
        $user->addresses()->create([
            'name'       => $request->name,
            'phone'       => $request->phone,
            'street'      => $request->street,
            'landmark'    => $request->landmark,
            'city'        => $request->city,
            'state'       => $request->state,
            'country'     => $request->country,
            'postal_code' => $request->postal_code,
            'type'        => 'main',
        ]);

    }

    return redirect()->route('user.pages.index')
                     ->with('success', 'Profile updated successfully!');
}

 
    
}
