<?php

namespace App\Http\Controllers;

use App\Models\UserRole;
use Illuminate\Http\Request;

class MemberRoleConroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $member_roles = UserRole::latest()->paginate(10);
        return view('dashboard.pages.admin.member-role.index', compact('member_roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pages.admin.member-role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255|unique:user_roles,name',
            'is_active' => 'required|boolean',
        ]);

        UserRole::create([
            'name'      => $request->name,
            'is_active' => $request->is_active,
        ]);

        return redirect()
            ->route('admin.member-role.index')
            ->with('success', 'Member role created successfully.');
    }

   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserRole $member_role)
    {
        return view('dashboard.pages.admin.member-role.edit', compact('member_role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserRole $member_role)
    {
        $request->validate([
            'name'      => 'required|string|max:255|unique:user_roles,name,' . $member_role->id,
            'is_active' => 'required|boolean',
        ]);

        $member_role->update([
            'name'      => $request->name,
            'is_active' => $request->is_active,
        ]);

        return redirect()
            ->route('admin.member-role.index')
            ->with('success', 'Member role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserRole $member_role)
    {
        $member_role->delete();

        return redirect()
            ->route('admin.member-role.index')
            ->with('success', 'Member role deleted successfully.');
    }
}
