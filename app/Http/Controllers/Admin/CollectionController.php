<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Collection;
use Illuminate\Support\Facades\URL;
use App\Http\Helpers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CollectionController extends Controller
{

    public function index()
    {
        $collection = Collection::all();
        return view('admin.collection', compact('collection'));
    }
    public function create()
    {
        return view('admin.collection.edit');
    }
    public function store(Request $request)
    {
        $collection = new Collection();
        $collection->collection_name_ru = (!empty($request->collection_name_ru)) ? $request->collection_name_ru : null;
        $collection->collection_name_kz = (!empty($request->collection_name_kz)) ? $request->collection_name_kz : null;
        $collection->sort_num = $request->sort_num;
        $collection->color = $request->color;
        if (!$request->has('show_badge')) {
            $collection->show_badge = 0;
        }


        if ($request->hasFile('book_image')) {
            $image = $request->file('book_image');
            $image_name = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $destinationPath = $request->disk . '/' . date('Y') . '/' . date('m') . '/' . date('d');
            $image_name = $destinationPath . '/' . $image_name;

            if (Storage::disk('image')->exists($image_name)) {
                $now = \DateTime::createFromFormat('U.u', microtime(true));
                $image_name = $destinationPath . '/' . $now->format("Hisu") . '.' . $extension;
            }

            Storage::disk('image')->put($image_name, File::get($image));
            $result = '/media' .$image_name;
            $collection->icon = $result;
        }
        $collection->save();

        return redirect('/admin/collection');
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $collection = Collection::find($id);
        return view('admin.collection.edit', compact('collection'));
    }
    public function update(Request $request, $id)
    {
        $collection = Collection::find($id);
        $collection->collection_name_ru = $request->collection_name_ru;
        $collection->collection_name_kz = $request->collection_name_kz;
        $collection->sort_num = $request->sort_num;
        $collection->color = $request->color;
        if ($request->has('show_badge')) {
            $collection->show_badge = 1;
        }
        else{
            $collection->show_badge = 0;

        }

        if($request->hasFile('book_image')){
            $result=Helpers::storeImg('book_image', 'image', $request);;
        }
        else{
            $result=$collection->icon;
        }
        $collection->icon = $result;
        $collection->save();

        return redirect('/admin/collection');
    }
    public function destroy($id)
    {

        $collection = Collection::find($id);
        foreach ($collection->books as $book){
            $book->book_collection_id=null;
            $book->save();
        }
        $collection->delete();
        return back();
    }
}
