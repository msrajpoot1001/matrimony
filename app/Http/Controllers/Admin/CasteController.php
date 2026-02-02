<?php

namespace App\Http\Controllers\Admin;

use App\Models\Caste;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;  
use App\Models\SubCaste;
class CasteController extends Controller
{

public function getSubCastes($casteId)
{
    // Check if casteId exists
    if(!$casteId){
        return response()->json([]);
    }

    // Fetch sub-castes
    $subCastes = SubCaste::where('ref_id', $casteId)->get();

    return response()->json($subCastes);
}


    public function index()
    {
        $items = Caste::latest()->get();
        return view('dashboard.pages.admin.caste.caste', compact('items'));

    }

    public function create() {}

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
        'is_active' => 'required|boolean'
        ]);
        

        Caste::create($data);
        return redirect()->route('admin.caste.index')->with('success', 'Caste created successfully.');
    }

    public function edit(string $id)
    {
        $item = Caste::findOrFail($id);
   return view("dashboard.pages.admin.caste.caste-edit", compact('item'));



    }

    public function update(Request $request, string $id)
    {
        $item = Caste::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
        'is_active' => 'required|boolean'
        ]);

        $data = $request->only(['name', 'is_active']);

                $photoFields = [''];

        foreach ($photoFields as $field) {
            $statusField = 'status_' . $field;

            if ($request->input($statusField)) {
                if ($request->hasFile($field)) {
                    if (!empty($item->$field) && file_exists(public_path($item->$field))) {
                        unlink(public_path($item->$field));
                    }

                    $folder = 'upload/castes';
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

        return redirect()->route('admin.caste.index')->with('success', 'Caste updated successfully.');
    }

   public function destroy(string $id)
{
    $item = Caste::findOrFail($id);


    $item->delete();

    return redirect()->route('admin.caste.index')->with('success', 'Caste deleted successfully.');
}

}