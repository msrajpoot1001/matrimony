<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{

    public function index()
    {
        $items = Advertisement::latest()->get();
        return view('dashboard.pages.admin.adv.advertisement', compact('items'));

    }


    public function store(Request $request)
    {
        $data = $request->validate([
        'photo' => 'image|mimes:jpg,jpeg,png|max:2048|nullable',
        'heading' => 'required|string',
        'sub_heading' => 'required|string',
        'description' => 'nullable|string',
        'is_active' => 'required|boolean'
        ]);
        
        if ($request->hasFile('photo')) {
            $folder = 'upload/advertisements';
            $path = public_path($folder);
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('photo');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $filename);
            $data['photo'] = $folder . '/' . $filename;
        }

        Advertisement::create($data);
        return redirect()->route('admin.advertisement.index')->with('success', 'Advertisement created successfully.');
    }

    public function edit(string $id)
    {
        $item = Advertisement::findOrFail($id);
        return view("dashboard.pages.admin.adv.advertisement-edit", compact('item'));

    }

    public function update(Request $request, string $id)
    {
        $item = Advertisement::findOrFail($id);

        $request->validate([
            'status_photo' => 'nullable|in:0,1',
        'heading' => 'required|string',
        'sub_heading' => 'required|string',
        'description' => 'nullable|string',
        'is_active' => 'required|boolean'
        ]);

        $data = $request->only(['heading', 'sub_heading', 'description', 'is_active']);

                $photoFields = ['photo'];

        foreach ($photoFields as $field) {
            $statusField = 'status_' . $field;

            if ($request->input($statusField)) {
                if ($request->hasFile($field)) {
                    if (!empty($item->$field) && file_exists(public_path($item->$field))) {
                        unlink(public_path($item->$field));
                    }

                    $folder = 'upload/advertisements';
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

        return redirect()->route('admin.advertisement.index')->with('success', 'Advertisement updated successfully.');
    }

   public function destroy(string $id)
    {   
        $item = Advertisement::findOrFail($id);

            if (!empty($item->photo) && file_exists(public_path($item->photo))) {
            unlink(public_path($item->photo));
        }

        $item->delete();

        return redirect()->route('admin.advertisement.index')->with('success', 'Advertisement deleted successfully.');
    }

}