<?php

namespace App\Http\Controllers\Admin;

use App\Models\HappyStory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HappyStoryController extends Controller
{

    public function index()
    {
        $items = HappyStory::latest()->get();
        return view('dashboard.pages.admin.happy-story.index', compact('items'));



    }

    public function create() {}

    public function store(Request $request)
    {
        $data = $request->validate([
            'photo' => 'image|mimes:jpg,jpeg,png,webp|max:2048|nullable',
        'reason' => 'required|string',
        'heading' => 'nullable|string',
        'sub_heading' => 'nullable|string',
        'date' => 'nullable|string',
        'is_active' => 'required|boolean'
        ]);
        
        if ($request->hasFile('photo')) {
            $folder = 'upload/happy_stories';
            $path = public_path($folder);
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('photo');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $filename);
            $data['photo'] = $folder . '/' . $filename;
        }

        HappyStory::create($data);
        return redirect()->route('admin.happy-story.index')->with('success', 'HappyStory created successfully.');
    }

    public function edit(string $id)
    {
        $item = HappyStory::findOrFail($id);
   return view("dashboard.pages.admin.happy-story.edit", compact('item'));



    }

    public function update(Request $request, string $id)
    {
        $item = HappyStory::findOrFail($id);

        $request->validate([
            'status_photo' => 'nullable|in:0,1',
        'reason' => 'required|string',
        'heading' => 'nullable|string',
        'sub_heading' => 'nullable|string',
        'date' => 'nullable|string',
        'is_active' => 'required|boolean'
        ]);

        $data = $request->only(['reason', 'heading', 'sub_heading', 'date', 'is_active']);

                $photoFields = ['photo'];

        foreach ($photoFields as $field) {
            $statusField = 'status_' . $field;

            if ($request->input($statusField)) {
                if ($request->hasFile($field)) {
                    if (!empty($item->$field) && file_exists(public_path($item->$field))) {
                        unlink(public_path($item->$field));
                    }

                    $folder = 'upload/happy_stories';
                    $path = public_path($folder);
                    if (!file_exists($path)) {
                        mkdir($path, 0777, true);
                    }

                    $file = $request->file($field);
                    $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move($path, $filename);

                    $data[$field] = $folder . '/' . $filename;
                } else {
                    $data[$field] = $item->$field;
                }
            } else {
                if (!empty($item->$field) && file_exists(public_path($item->$field))) {
                    unlink(public_path($item->$field));
                }

                $data[$field] = null;
            }
        }

        $item->update($data);

        return redirect()->route('admin.happy-story.index')->with('success', 'HappyStory updated successfully.');
    }

   public function destroy(string $id)
{
    $item = HappyStory::findOrFail($id);

        if (!empty($item->photo) && file_exists(public_path($item->photo))) {
            unlink(public_path($item->photo));
        }

    $item->delete();

    return redirect()->route('admin.happy-story.index')->with('success', 'HappyStory deleted successfully.');
}

}