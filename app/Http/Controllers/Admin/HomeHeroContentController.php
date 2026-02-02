<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeHeroContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeHeroContentController extends Controller
{
    public function index()
    {
        $heroes = HomeHeroContent::latest()->get();
        return view('dashboard.pages.admin.frontend-content.home-hero', compact('heroes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'bg_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10048',
            'status' => 'required|boolean',
        ]);

        $path = null;

        if ($request->hasFile('bg_image')) {

            $uploadPath = public_path('uploads/home/home');

            // create directory if not exists
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            $image = $request->file('bg_image');
            $filename = time().'_'.$image->getClientOriginalName();
            $image->move($uploadPath, $filename);

            $path = 'uploads/home/home/'.$filename;
        }

        HomeHeroContent::create([
            'title' => $request->title,
            'bg_image' => $path,
            'status' => $request->status,
        ]);

        return back()->with('success', 'Hero content created successfully.');
    }

    public function edit(HomeHeroContent $heroContent)
    {
        return view(
        'dashboard.pages.admin.frontend-content.home-hero-edit',
        [
            'item' => $heroContent
        ]
        );
    }


    
    


    public function update(Request $request, HomeHeroContent $heroContent)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'bg_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10048',
            'status' => 'required|boolean',
        ]);

        if ($request->hasFile('bg_image')) {

            // delete old image
            if ($heroContent->bg_image && File::exists(public_path($heroContent->bg_image))) {
                File::delete(public_path($heroContent->bg_image));
            }

            $uploadPath = public_path('uploads/home/home');

            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            $image = $request->file('bg_image');
            $filename = time().'_'.$image->getClientOriginalName();
            $image->move($uploadPath, $filename);

            $heroContent->bg_image = 'uploads/home/home/'.$filename;
        }

        $heroContent->update([
            'title' => $request->title,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.hero-contents.index')->with('success', 'Hero content updated successfully.');
    }

    public function destroy(HomeHeroContent $heroContent)
{
    // Delete image from public folder
    if ($heroContent->bg_image && file_exists(public_path($heroContent->bg_image))) {
        unlink(public_path($heroContent->bg_image));
    }

    // Delete record
    $heroContent->delete();

    return back()->with('success', 'Hero content deleted successfully.');
}

}
