<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\Http\Helpers;

class SliderController extends Controller
{

    public function index()
    {
        $slider = Slider::all();

        return view('admin.slider.slider', compact('slider'));
    }
    public function create()
    {
        $books=\App\Models\Book::all();
        $title = 'Добавить слайдер';
        $action = '/admin/slider';
        return view('admin.slider.form',compact('action','title','books'));
    }

    public function store(Request $request)
    {
        if($request->slider_type=='bottom'){
            $request->validate([
                'slider_name'=>'required',
                'slider_type'=>'required',
                'sort_num'=>'required'
            ]);
        }
        else{
            $request->validate([
                'slider_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'adaptive_image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
               // 'url_ru'=>'required',
                //'url_kz'=>'required',
                'slider_name'=>'required',
                'slider_type'=>'required',
                'sort_num'=>'required',
            ]);
        }

        if($request->type=='book'){
            if(is_null($request->book_id)){
                dd('Выберите книгу');
            }
        }
        else{
            if(is_null($request->catalog_id)){
                dd('Выберите каталог');
            }

        }

        $slider = new Slider();
        $slider->slider_name = $request->slider_name;
        if($request->has('slider_image')) {
            $slider->slider_image = Helpers::storeImg('slider_image', 'image', $request);
        }
        if($request->has('adaptive_image')) {
            $slider->adaptive_image = Helpers::storeImg('adaptive_image', 'image', $request);
        }
        $slider->sort_num = $request->sort_num;
        //$slider->url_ru = $request->url_ru;
        //$slider->url_kz = $request->url_kz;
        $slider->book_id = $request->book_id;
        $slider->type = $request->type;
        $slider->slider_type = $request->slider_type;

        if($request->type=='book'){
            $slider->book_id=$request->book_id;
        }
        else if($request->type=='collection'){
            $slider->collection_id=$request->collection_id;
        }
        else{
            $slider->catalog_id=$request->catalog_id;
        }
        $slider->save();

        return redirect('/admin/slider');
    }

    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $books=\App\Models\Book::all();
        $title = 'Изменить слайдер';
        $action = '/admin/slider/'.$id;
        $slider = Slider::find($id);
        return view('admin.slider.form', compact('slider','action','title','books'));
    }
    public function update(Request $request, $id)
    {
        if($request->type=='book'){
            if(is_null($request->book_id)){
                dd('Выберите книгу');
            }
        }
        else{
            if(is_null($request->catalog_id)){
                dd('Выберите каталог');
            }

        }


        $slider = Slider::find($id);

        if ($request->hasFile('slider_image')) {
            $result = Helpers::storeImg('slider_image', 'image', $request);
        }else {
            $result = $slider->slider_image;
        }

        if ($request->hasFile('adaptive_image')) {
            $result_kz = Helpers::storeImg('adaptive_image', 'image', $request);
        }else {
            $result_kz = $slider->adaptive_image;
        }

        $slider->slider_name = $request->slider_name;
        $slider->slider_image = $result;
        $slider->adaptive_image = $result_kz;
        $slider->sort_num = $request->sort_num;
      //  $slider->url_ru = $request->url_ru;
       // $slider->url_kz = $request->url_kz;
        $slider->book_id = $request->book_id;
        $slider->slider_type = $request->slider_type;
        $slider->type = $request->type;

        if($request->type=='book'){
            $slider->book_id=$request->book_id;
        }
        else  if($request->type=='collection'){
            $slider->collection_id=$request->collection_id;
        }
        else{
            $slider->catalog_id=$request->catalog_id;
        }
        $slider->save();

        return redirect("/admin/slider");
    }
    public function destroy($id)
    {
        $slider = Slider::find($id);
        $slider->delete();
    }

    public function storeImg($name, $request)
    {
        $image = $request->file($name);
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
        return $result;
    }
}
