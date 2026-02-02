<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class RecycleBinController extends Controller
{
    public function index()
{
    $models = config('recyclebin');
    $trashedData = [];

    foreach ($models as $modelClass) {
        $trashedData[$modelClass] = $modelClass::onlyTrashed()
            ->latest('deleted_at')
            ->get();
    }
    // dd($trashedData);

    return view('admin::recycle-bin.recycle-bin', compact('trashedData'));
}


    public function restore(Request $request)
{
    $request->validate([
        'model' => 'required|string',
        'id'    => 'required|numeric',
    ]);

    $modelClass = $request->model;

    abort_unless(in_array($modelClass, config('recyclebin')), 403);

    $item = $modelClass::onlyTrashed()->findOrFail($request->id);

    // ✅ clear delete meta before restore
    $item->delete_reason = null;
    $item->deleted_by    = null;
    // deleted_at will be cleared automatically by restore()

    $item->saveQuietly();  // or save()

    $item->restore();

    return back()->with('success', 'Item restored successfully.');
}


    public function forceDelete(Request $request)
    {
        $request->validate([
            'model' => 'required|string',
            'id'    => 'required|numeric',
        ]);

        $modelClass = $request->model;

        abort_unless(in_array($modelClass, config('recyclebin')), 403);

        $item = $modelClass::onlyTrashed()->findOrFail($request->id);

        // If model has file you can handle here per model (optional)
        // e.g. if ($modelClass === Testimonial::class) delete file

        $item->forceDelete();

        return back()->with('success', 'Item permanently deleted.');
    }
}
