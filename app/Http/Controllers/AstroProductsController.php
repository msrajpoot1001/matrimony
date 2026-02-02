<?php

namespace App\Http\Controllers;

use App\Models\AstroProducts;
use Illuminate\Http\Request;

class AstroProductsController extends Controller
{

    public function index()
    {
        $items = AstroProducts::latest()->get();
        return view('dashboard.pages.admin.astro-products.index', compact('items'));

    }

    public function create() {}

    public function store(Request $request)
    {
        $data = $request->validate([
            'photo' => 'image|mimes:jpg,jpeg,png,webp|max:2048|nullable',
        'name' => 'required|string',
        'price' => 'required|string',
        'short_description' => 'nullable|string',
        'description' => 'nullable|string',
        'is_active' => 'required|boolean'
        ]);
        
        if ($request->hasFile('photo')) {
            $folder = 'upload/astro_products';
            $path = public_path($folder);
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('photo');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $filename);
            $data['photo'] = $folder . '/' . $filename;
        }

        AstroProducts::create($data);
        return redirect()->route('admin.astro-products.index')->with('success', 'AstroProducts created successfully.');
    }

    public function edit(string $id)
    {
        $item = AstroProducts::findOrFail($id);
   return view("dashboard.pages.admin.astro-products.edit", compact('item'));



    }

    public function update(Request $request, string $id)
    {
        $item = AstroProducts::findOrFail($id);

        $request->validate([
            'status_photo' => 'nullable|in:0,1',
        'name' => 'required|string',
        'price' => 'required|string',
        'short_description' => 'nullable|string',
        'description' => 'nullable|string',
        'is_active' => 'required|boolean'
        ]);

        $data = $request->only(['name', 'price', 'short_description', 'description', 'is_active']);

                $photoFields = ['photo'];

        foreach ($photoFields as $field) {
            $statusField = 'status_' . $field;

            if ($request->input($statusField)) {
                if ($request->hasFile($field)) {
                    if (!empty($item->$field) && file_exists(public_path($item->$field))) {
                        unlink(public_path($item->$field));
                    }

                    $folder = 'upload/astro_products';
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

        return redirect()->route('admin.astro-products.index')->with('success', 'AstroProducts updated successfully.');
    }

   public function destroy(string $id)
{
    $item = AstroProducts::findOrFail($id);

        if (!empty($item->photo) && file_exists(public_path($item->photo))) {
            unlink(public_path($item->photo));
        }

    $item->delete();

    return redirect()->route('admin.astro-products.index')->with('success', 'AstroProducts deleted successfully.');
}

}