<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Chapter;

class ChaptersController extends Controller
{
    public function index()
    {
        $chapter = Chapter::all();
        return view('admin.chapter.chapter', compact('chapter'));
    }

    public function create()
    {
        return view('admin.chapter.chapter-edit');
    }

    public function store(Request $request)
    {
        $chapter = new Chapter();
        $chapter->ch_book_id = $request->ch_book_id;
        $chapter->chapter_name = $request->chapter_name;
        $chapter->chapter_time = $request->chapter_time;
        $chapter->sort_num = $request->sort_num;
        $chapter->save();

        return redirect('/admin/chapter');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $chapter = Chapter::find($id);
        return view('admin.chapter.chapter-edit', compact('chapter'));
    }

    public function update(Request $request, $id)
    {
        Chapter::where('chapter_id', $id)
                ->update([
                    'ch_book_id' => $request->ch_book_id,
                    'chapter_name' => $request->chapter_name,
                    'chapter_time' => $request->chapter_time,
                    'sort_num' => $request->sort_num
                ]);

        return redirect('/admin/chapter');
    }

    public function destroy($id)
    {
        $chapter = Chapter::find($id);
        $chapter->delete(); 
    }
}
