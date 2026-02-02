<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KarmaTrainingContent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KarmaTrainingContentController extends Controller
{
    public function index()
    {
        $items = KarmaTrainingContent::latest()->paginate(10);
        return view('dashboard.pages.admin.karma-training-content.index', compact('items'));
    }

    public function create()
    {
        return view('dashboard.pages.admin.karma-training-content.create');
    }



public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'photo' => 'nullable|mimes:jpg,jpeg,png,webp,mp4,mov,avi,webm|max:20480',
        'short_description' => 'nullable|string|max:499',
        'description' => 'nullable|string',
          'author_name' => 'required|string|max:255',
           'author_photo' => 'nullable|mimes:jpg,jpeg,png,webp,mp4,mov,avi,webm|max:20480',
           'author_description' => 'nullable|string',
        'is_active' => 'nullable|string',
    ]);

    // Handle file upload (image or video)
    if ($request->hasFile('photo')) {

        $file = $request->file('photo');
        $extension = $file->getClientOriginalExtension();

        $filename = time() . '_' . Str::random(8) . '.' . $extension;
        $destination = public_path('uploads/karma-training-content');

        if (!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }

        $file->move($destination, $filename);

        $validated['photo'] = 'uploads/karma-training-content/' . $filename;
    }

    KarmaTrainingContent::create($validated);

    return redirect()
        ->route('admin.karma-training-content.index')
        ->with('success', 'Karma Training Content created successfully.');
}



public function edit($id)
{
    $item = KarmaTrainingContent::findOrFail($id);

    return view(
        'dashboard.pages.admin.karma-training-content.edit',
        compact('item')
    );
}


public function update(Request $request, $id)
{
    $item = KarmaTrainingContent::findOrFail($id);

    $validated = $request->validate([
        'title'       => 'required|string|max:255',
        'author_name'       => 'required|string|max:255',
         'status_photo' => 'nullable|in:0,1',
          'status_author_name' => 'nullable|in:0,1',
          'short_description' => 'nullable|string|max:499',
        'description' => 'nullable|string',
        'author_description' => 'nullable|string',
    ]);

     $data = $request->only(['title','short_description',  'description','author_name','author_photo','author_description', 'is_active' ]);
       $photoFields = ['photo','author_photo'];
    // Handle photo upload
  
        foreach ($photoFields as $field) {
            $statusField = 'status_' . $field;

            if ($request->input($statusField)) {
                if ($request->hasFile($field)) {
                    if (!empty($item->$field) && file_exists(public_path($item->$field))) {
                        unlink(public_path($item->$field));
                    }

                    $folder = 'upload/testimonials';
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

    return redirect()
        ->route('admin.karma-training-content.index')
        ->with('success', 'Karma Training Content updated successfully.');
}



   public function destroy($id)
{
    $item = KarmaTrainingContent::findOrFail($id);

    // Delete image from public/uploads/karma-training-content
    if ($item->photo && file_exists(public_path($item->photo))) {
        unlink(public_path($item->photo));
    }

    // Soft delete record
    $item->delete();

    return back()->with('success', 'Karma Training Content deleted successfully.');
}

}
