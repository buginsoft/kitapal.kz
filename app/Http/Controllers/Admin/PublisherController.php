<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Publisher;
use App\Http\Helpers;

class PublisherController extends Controller
{
    public function index()
    {
        $publisher =  Publisher::all();
        return view('admin.publisher.index',compact('publisher'));
    }

    public function create()
    {
        $title = 'Добавить издателя';
        $action = '/admin/publisher';
        return view('admin.publisher.form',compact('action','title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_kz' => 'required',
            'name_ru' => 'required',
        ]);

        $result = '/media/author.jpg';
        if ($request->hasFile('photo')) {
            $result = Helpers::storeImg('photo','image',$request);
        }

        Publisher::create([
            'name_kz'=>$request->name_kz,
            'name_ru'=>$request->name_ru,
            'description_kz'=>$request->description_kz,
            'description_ru'=>$request->description_ru,
            'source_kz'=>$request->source_kz,
            'source_ru'=>$request->source_ru,
            'photo'=>$result,
            'facebook'=>$request->facebook,
            'twitter'=>$request->twitter,
            'vk'=>$request->vk,
            'instagram'=>$request->instagram,
            'telegram'=>$request->telegram
        ]);
        return redirect('/admin/publisher');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $title = 'Изменить издателя';
        $action ='/admin/publisher/'.$id;
        $publisher = Publisher::find($id);
        return view('admin.publisher.form', compact('publisher','action','title'));
    }

    public function update(Request $request, $id)
    {

        $publisher = Publisher::find($id);
        $request->validate([
            'name_kz' => 'required',
            'name_ru' => 'required',
        ]);


        $result = $publisher->photo;
        if($request->hasFile('photo')) {
            if ($request->hasFile('photo')) {
                $result = Helpers::storeImg('photo', 'image', $request);
            }
        }

        $publisher->update([
            'name_kz'=>$request->name_kz,
            'name_ru'=>$request->name_ru,
            'description_kz'=>$request->description_kz,
            'description_ru'=>$request->description_ru,
            'source_kz'=>$request->source_kz,
            'source_ru'=>$request->source_ru,
            'photo'=>$result,
            'facebook'=>$request->facebook,
            'twitter'=>$request->twitter,
            'vk'=>$request->vk,
            'instagram'=>$request->instagram,
            'telegram'=>$request->telegram
        ]);

        return redirect("/admin/publisher");
    }

    public function destroy($id)
    {
      Publisher::find($id)->delete();
    }
}
