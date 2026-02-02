<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserRole;
use App\Http\Controllers\Controller;  

class MemberManagementController extends Controller
{
  public function index()
{
    $user = auth()->user(); // current logged-in user

    $users = User::with('userRole')
                ->where('id', '!=', $user->id) // exclude logged-in user
                ->latest()
                ->get();

    return view('admin::member-management.members', compact('users'));
}


    public function edit($id){
        $user = User::findOrFail($id);
         $user_roles = UserRole::latest()->get();
        return view("admin::member-management.member-edit", compact('user','user_roles'));

    }

 public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'role' => 'required|exists:user_roles,id',
    ]);

    $user->role = $request->role;
    $user->save();

    return redirect()
    ->route('admin.members.index')
    ->with('success', 'User updated successfully.');

}


public function memberProfile($id = null)
{
    // If no ID is passed, use logged-in user ID
    if (!$id) {
        $id = auth()->id();
    }

    // Load user details with relationships
    $user = User::with(['profile', 'addresses'])->findOrFail($id);
    // dd($user);

    return view("admin::member-management.member-profile-detail", compact('user'));
}



}
