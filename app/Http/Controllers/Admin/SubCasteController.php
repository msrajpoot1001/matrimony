<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;  
use App\Models\SubCaste;
use Illuminate\Http\Request;
use App\Models\Caste;

class SubCasteController extends Controller
{
public function index(Request $request)
{
    // Get caste id from query
    $casteId = $request->query('ref_id');

    // All castes for dropdown
    $items1 = Caste::get();

    // Fetch sub-castes based on selected caste
    if($casteId){
        $items2 = SubCaste::where('ref_id', $casteId)
                    ->with('caste')
                    ->paginate(20)
                    ->withQueryString(); // keep query param in pagination links
    } else {
        $items2 = SubCaste::with('caste')
                    ->paginate(20);
    }

    return view('dashboard.pages.admin.caste.sub-caste', compact('items1', 'items2', 'casteId'));
}


   public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string',
            'is_active' => 'required|boolean',
            'ref_id' => 'required|exists:castes,id'
    ]);
    

    SubCaste::create($data);
    return redirect()->route('admin.sub-caste.index')->with('success', 'SubCaste created successfully.');
}


    public function edit(string $id)
    {
        $items1 = Caste::get();
        $item2 = SubCaste::findOrFail($id);
        return view('dashboard.pages.admin.caste.sub-caste-edit', compact('items1', 'item2'));
    }

    public function update(Request $request, string $id)
{
    $item = SubCaste::findOrFail($id);
    $data = $request->validate([
        'name' => 'required|string',
            'is_active' => 'required|boolean',
            'ref_id' => 'required|exists:castes,id'
    ]);

            $photoFields = [''];

        foreach ($photoFields as $field) {
            $statusField = 'status_' . $field;

            if ($request->input($statusField)) {
                if ($request->hasFile($field)) {
                    if (!empty($item->$field) && file_exists(public_path($item->$field))) {
                        unlink(public_path($item->$field));
                    }

                    $folder = 'upload/sub_castes';
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
    return redirect()->route('admin.sub-caste.index')->with('success', 'SubCaste updated successfully.');
}



    public function destroy(string $id)
    {
        $item = SubCaste::findOrFail($id);
        
        $item->delete();
        return redirect()->route('admin.sub-caste.index')->with('success', 'SubCaste deleted successfully.');
    }

    

}