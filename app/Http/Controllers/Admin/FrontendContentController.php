<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FrontendContent;
use Illuminate\Http\Request;

class FrontendContentController extends Controller
{
    /**
     * Display all records
     */
    public function index()
    {
        $item = FrontendContent::latest()->first();
        return view('dashboard.pages.admin.frontend-content.frontend-content', compact('item'));
    }

    /**
     * Store new record
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'query_form' => 'required|boolean',
             'chat_bot' => 'required|boolean',
            'experience' => 'nullable|string',
            'active_members' => 'nullable|string',
            'active_members' => 'nullable|string',
        ]);

        FrontendContent::create($validated);

        return back()->with('success', 'Frontend content created successfully.');
    }

    /**
     * Edit form (ID based)
     */
    public function edit($id)
    {
        $item = FrontendContent::findOrFail($id);

        return view(
            'dashboard.pages.admin.frontend-content.frontend-content-edit',
            compact('item')
        );
    }

    /**
     * Update record (ID based)
     */
    public function update(Request $request, $id)
    {
        $item = FrontendContent::findOrFail($id);

        $validated = $request->validate([
            'query_form' => 'required|boolean',
             'chat_bot' => 'required|boolean',
            'experience' => 'nullable|string',
            'active_members' => 'nullable|string',
            'successfull_marriage' => 'nullable|string',
        ]);

        $item->update($validated);

        return redirect()
            ->route('admin.frontend-content.index')
            ->with('success', 'Frontend content updated successfully.');
    }

    /**
     * Soft delete record (ID based)
     */
    public function destroy($id)
    {
        $item = FrontendContent::findOrFail($id);

        $item->delete();

        return back()->with('success', 'Frontend content deleted successfully.');
    }
}
