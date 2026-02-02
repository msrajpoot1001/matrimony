<?php

namespace App\Http\Controllers\Admin;

use App\Models\SeoPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;  

class SeoPageController extends Controller
{
    public function index()
    {
        $items = SeoPage::latest()->get();
        return view('admin::seo-pages.seo-pages', compact('items'));

    }

    public function create() {}

    public function store(Request $request)
    {
        $data = $request->validate([
            'page_name' => 'nullable|string',
        'title' => 'nullable|string|max:1000',
    'description' => 'nullable|string|max:2000',
    'keywords' => 'nullable|string|max:1000',
        'is_active' => 'required|boolean'
        ]);
        

        SeoPage::create($data);
        return redirect()->route('admin-seo-pages.index')->with('success', 'SeoPage created successfully.');
    }

    public function edit(string $id)
    {
        $item = SeoPage::findOrFail($id);
   return view("admin::seo-pages.seo-pages-edit", compact('item'));



    }

    public function update(Request $request, string $id)
    {
        $item = SeoPage::findOrFail($id);

        $request->validate([
            'page_name' => 'nullable|string',
            'title' => 'nullable|string|max:1000',
            'description' => 'nullable|string|max:1000',
            'keywords' => 'nullable|string|max:1000',
            'is_active' => 'required|boolean'
        ]);

        $data = $request->only(['page_name', 'title', 'description', 'keywords', 'is_active']);

                $photoFields = [''];

        foreach ($photoFields as $field) {
            $statusField = 'status_' . $field;

            if ($request->input($statusField)) {
                if ($request->hasFile($field)) {
                    if (!empty($item->$field) && file_exists(public_path($item->$field))) {
                        unlink(public_path($item->$field));
                    }

                    $folder = 'upload/seo_pages';
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

        return redirect()->route('admin.seo-pages.index')->with('success', 'SeoPage updated successfully.');
    }

   public function destroy(string $id)
{
    $item = SeoPage::findOrFail($id);


    $item->delete();

    return redirect()->route('admin-seo-pages.index')->with('success', 'SeoPage deleted successfully.');
}

}