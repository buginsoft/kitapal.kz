<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;

class TranslatorController extends Controller
{

    public function index(Request $request)
    {
        if($request->has('s')){
            $translator = Author::where('translator',1)->where('name_ru','like','%'.$request->s.'%')->get();
        }
        else{
            $translator = Author::where('translator',1)->get();
        }
        return view('admin.translator.index', compact('translator'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_kz' => 'required',
        ]);
        $author = new Author();

        if($request->has('name_kz')){
            $author->name_kz = $request->name_kz;
        }
        if($request->has('name_ru')){
            $author->name_ru = $request->name_ru;
        }
        $author->translator=1;
        $author->save();

        return redirect('/admin/translator');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $translator = Author::find($id);
        return view('admin/translator/edit',  compact('translator'));
    }

    public function update(Request $request, $id)
    {
        Author::where('id', $id)
            ->update([
                'name_ru' => $request->name_ru,
                'name_kz' => $request->name_kz,
            ]);

        return redirect('/admin/translator');
    }
    public function destroy($id)
    {
        $genre = Author::find($id);
        $genre->delete();
    }
}
