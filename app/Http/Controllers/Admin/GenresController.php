<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;

class GenresController extends Controller
{
    public function index(){
        $genre = Genre::all();
        return view('admin.genre.genre', compact('genre'));
    }
    public function create(){
        $title='Добавить Жанр';
        $action = '/admin/genre';
        return view('admin.genre.form',compact('action','title'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'genre_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('genre_image')) {
            $image = $request->file('genre_image');
            $image_name = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $destinationPath = $request->disk . '/' . date('Y') . '/' . date('m') . '/' . date('d');
            $image_name = $destinationPath . '/' . $image_name;

            if (Storage::disk('image')->exists($image_name)) {
                $now = \DateTime::createFromFormat('U.u', microtime(true));
                $file_name = $destinationPath . '/' . $now->format("Hisu") . '.' . $extension;
            }

            Storage::disk('image')->put($image_name, File::get($image));
            $result = URL::to('/').'/media' .$image_name;
        }

        $genre = new Genre();
        $genre->genre_name_ru = $request->genre_name_ru;
        $genre->genre_name_kz = (!empty($request->genre_name_kz)) ? $request->genre_name_kz : $request->genre_name_ru;
        $genre->genre_name_en = (!empty($request->genre_name_en)) ? $request->genre_name_en : $request->genre_name_ru;
        $genre->genre_image = $result;
        if($request->has('showonheader')){
            $genre->showonheader=$request->showonheader;
        }
        $genre->sort_num = $request->sort_num;
        $genre->save();

        return redirect('/admin/genre');
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $title='Изменить жанр';
        $action = '/admin/genre/'.$id;
        $genre = Genre::find($id);
        return view('admin.genre.form', compact('genre','action','title'));
    }
    public function update(Request $request, $id)
    {

        $genre = Genre::find($id);

        if ($request->hasFile('genre_image')) {
            $image = $request->file('genre_image');
            $image_name = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $destinationPath = $request->disk . '/' . date('Y') . '/' . date('m') . '/' . date('d');
            $image_name = $destinationPath . '/' . $image_name;

            if (Storage::disk('image')->exists($image_name)) {
                $now = \DateTime::createFromFormat('U.u', microtime(true));
                $file_name = $destinationPath . '/' . $now->format("Hisu") . '.' . $extension;
            }

            Storage::disk('image')->put($image_name, File::get($image));
            $result = URL::to('/').'/media' .$image_name;
        }else {
            $result = $genre->genre_image;
        }
        $genre->genre_image=$result;
        $genre->save();
        $genre->update($request->except(['_token','_method','MAX_FILE_SIZE','genre_image']));

        if($request->has('top_book_id')){
            \App\Models\BookGenre::where('bg_genre_id',$id)->update(['is_first_book'=>0]);
            if($request->top_book_id!=='0') {
                \App\Models\BookGenre::where([['bg_genre_id', $id], ['bg_book_id', $request->top_book_id]])->update(['is_first_book' => 1]);
            }

        }
        return redirect('/admin/genre');
    }
    public function destroy($id){
        $genre = Genre::find($id);
        $genre->delete();
    }
}
