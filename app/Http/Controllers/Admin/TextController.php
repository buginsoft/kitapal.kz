<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Text;

class TextController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $text = Text::all();
        return view('admin.text.text', compact('text'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.text.text-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $text = new Text();
        $text->title_ru = $request->title_ru;
        $text->title_kz = $request->title_kz;
        $text->title_en = $request->title_en;
        $text->text_ru = $request->text_ru;
        $text->text_kz = $request->text_kz;
        $text->text_en = $request->text_en;
        $text->text_place = $request->text_place;
        $text->save();

        return redirect('/admin/text');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $text = Text::find($id);
        return view('admin.text.text-edit', compact('text'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->has('show_free_page')){
            Text::where('text_id', $id)->update([
                'show_free_page' =>$request->show_free_page
            ]);
        }else{
            Text::where('text_id', $id)->update([
                'title_ru' => $request->title_ru,
                'title_kz' => $request->title_kz,
                'title_en' => $request->title_en,
                'text_ru' => $request->text_ru,
                'text_kz' => $request->text_kz,
                'text_en' => $request->text_en,
                'text_place' => $request->text_place
            ]);
        }


        return redirect('/admin/text');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $text = Text::find($id);
        $text->delete(); 
    }
}
