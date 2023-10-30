<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Page;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;

class MenuController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view('admin.menu.index' , compact('pages'));
    }
    public function create()
    {
        return view('admin.article.article-edit');
    }
    public function store(Request $request)
    {
        /*$request->validate([
            'book_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

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
            $result = URL::to('/').'/media' .$image_name;
        }

        $article = new Article();
        $article->title_ru = $request->title_ru;
        $article->text_ru = $request->text_ru;;
        $article->title_kz = $request->title_kz;
        $article->text_kz = $request->text_kz;
        $article->short_text_ru = $request->short_text_ru;
        $article->short_text_kz = $request->short_text_kz;
        $article->image = $result;
        $article->save();

        return redirect("/admin/article");*/
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $book = Book::find($id);
        return view('admin.book.book-edit', compact('book'));
    }
    public function update(Request $request, $id)
    {
       /* $request->validate([
            'book_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $book = Book::find($id);

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
            $result = URL::to('/').'/media' .$image_name;
        }else {
            $result = $book->main_image()->path;
        }

        if ($request->hasFile('audio_file')) {
            $cover = $request->file('audio_file');
            $resultall = "";
            foreach ($cover as $coverone) {
                $file_name = $coverone->getClientOriginalName();
                $extension = $coverone->getClientOriginalExtension();

                $destinationPath = $request->disk . '/' . date('Y') . '/' . date('m') . '/' . date('d');

                $file_name = $destinationPath . '/' . $file_name;

                if (Storage::disk('doc')->exists($file_name)) {
                    $now = \DateTime::createFromFormat('U.u', microtime(true));
                    $file_name = $destinationPath . '/' . $now->format("Hisu") . '.' . $extension;
                }

                Storage::disk('doc')->put($file_name, File::get($coverone));
                $resultall .= URL::to('/').'/media_doc' . $file_name;
                $result_size = $coverone->getSize()/10000000;
                $result_size = number_format((float)$result_size, 2, '.', '');
                $mp3file = new MP3File($coverone);
                $result_length = $mp3file->getDuration();
            }
        }else {
            $resultall = $book->audio_file;
            $result_size = $book->audio_size;
            $result_length = $book->audio_length;
        }

        Book::where('book_id', $id)
            ->update([
                'book_name' => $request->book_name,
                'book_image' => $result,
                'author' => $request->author,
                'book_description' => $request->book_description,
                'read_person' => $request->read_person,
                'audio_file' => $resultall,
                'audio_size' => $result_size,
                'audio_length' => $result_length,
                'copyright' => $request->copyright,
                'book_lang' => $request->book_lang,
                'book_collection_id' => (is_numeric($request->book_collection_id)) ? $request->book_collection_id : null
            ]);

        $list = array();
        foreach ($request->book_genre as $value) {
            array_push($list, $value);
        }

        $book->genres()->sync($list);

        return redirect("/admin/book");*/
    }
    public function destroy($id)
    {
        //$book = Book::find($id);
       // $book->delete();
    }
}
