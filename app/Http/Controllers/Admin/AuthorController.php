<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Author;
use \App\Http\Helpers;

class AuthorController extends Controller
{

    public function index(Request $request)
    {
        if($request->has('s')){
            $author = Author::where('name_ru','like','%'.$request->s.'%')->paginate(15);
        }
        else {
            $author = Author::paginate(15);
        }
        return view('admin.author.index', compact('author'));
    }

    public function create()
    {
        $action = '/admin/author';
        return view('admin/author/form',compact('action'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_kz' => 'required',
            'name_ru' => 'required',
        ]);

        $result = '/media/author.jpg';
        if ($request->hasFile('author_photo')) {
            $result = Helpers::storeImg('author_photo','image',$request);
        }

       Author::create([
           'name_kz'=>$request->name_kz,
           'name_ru'=>$request->name_ru,
           'description_kz'=>$request->description_kz,
           'description_ru'=>$request->description_ru,
           'source_kz'=>$request->source_kz,
           'source_ru'=>$request->source_ru,
           'author_photo'=>$result,
           'facebook'=>$request->facebook,
           'twitter'=>$request->twitter,
           'vk'=>$request->vk,
           'instagram'=>$request->instagram,
           'telegram'=>$request->telegram
       ]);
        return redirect('/admin/author');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $action = '/admin/author/'.$id;
        $author = Author::find($id);
        return view('admin/author/form',  compact('author','action'));
    }

    public function update(Request $request, $id)
    {
        $author = Author::find($id);
        $request->validate([
            'name_kz' => 'required',
            'name_ru' => 'required',
        ]);

        $result = $author->author_photo;
        if ($request->hasFile('author_photo')) {
            $result = Helpers::storeImg('author_photo','image',$request);
        }

        $author->update([
            'name_kz'=>$request->name_kz,
            'name_ru'=>$request->name_ru,
            'description_kz'=>$request->description_kz,
            'description_ru'=>$request->description_ru,
            'source_kz'=>$request->source_kz,
            'source_ru'=>$request->source_ru,
            'author_photo'=>$result,
            'facebook'=>$request->facebook,
            'twitter'=>$request->twitter,
            'vk'=>$request->vk,
            'instagram'=>$request->instagram,
            'telegram'=>$request->telegram
        ]);

        return back();
    }
    public function destroy($id)
    {
        $genre = Author::find($id);
        $genre->delete();
    }
    public function authorbooks($author_id){
        $author = Author::find($author_id);
        $books=$author->books()->paginate(10);
        return view('authorbooks',compact('books','author'));
    }
}
