<?php

namespace App\Http\Controllers\Admin;

use App\Models\Partner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;  

class PartnerController extends Controller
{

    public function index()
    {
        $items = Partner::latest()->get();
        return view('dashboard.pages.admin.partner.index', compact('items'));

    }

    public function create() {}

    public function store(Request $request)
    {
        $data = $request->validate([
            'photo' => 'image|mimes:jpg,jpeg,png|max:2048|nullable',
        'name' => 'required|string',
        'position' => 'nullable|string',
        'quali' => 'nullable|string',
        'description' => 'nullable|string',
        'is_active' => 'required|boolean'
        ]);
        
        if ($request->hasFile('photo')) {
            $folder = 'upload/partners';
            $path = public_path($folder);
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('photo');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $filename);
            $data['photo'] = $folder . '/' . $filename;
        }

        Partner::create($data);
        return redirect()->route('admin.partner.index')->with('success', 'Partner created successfully.');
    }

    public function edit(string $id)
    {
        $item = Partner::findOrFail($id);
        return view("dashboard.pages.admin.partner.edit", compact('item'));



    }

    public function update(Request $request, string $id)
    {
        $item = Partner::findOrFail($id);

        $request->validate([
            'status_photo' => 'nullable|in:0,1',
        'name' => 'required|string',
        'position' => 'nullable|string',
        'quali' => 'nullable|string',
        'description' => 'nullable|string',
        'is_active' => 'required|boolean'
        ]);

        $data = $request->only(['name', 'position', 'quali', 'description', 'is_active']);

                $photoFields = ['photo'];

        foreach ($photoFields as $field) {
            $statusField = 'status_' . $field;

            if ($request->input($statusField)) {
                if ($request->hasFile($field)) {
                    if (!empty($item->$field) && file_exists(public_path($item->$field))) {
                        unlink(public_path($item->$field));
                    }

                    $folder = 'upload/partners';
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

        return redirect()->route('admin.partner.index')->with('success', 'Partner updated successfully.');
    }

   public function destroy(string $id)
{
    $item = Partner::findOrFail($id);

        if (!empty($item->photo) && file_exists(public_path($item->photo))) {
            unlink(public_path($item->photo));
        }

    $item->delete();

    return redirect()->route('admin.partner.index')->with('success', 'Partner deleted successfully.');
}

}