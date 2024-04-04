<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Author;
use App\Models\Translator;
use App\Models\Genre;
use App\Models\BookGenre;
use App\Models\BookAuthor;
use App\Models\UserBooks;
use App\Models\Publisher;
use App\Http\Controllers\Admin\MP3File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\BookImages;
use App\Http\Helpers;

class BookController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('s')){
            $book = Book::where('book_name','like','%'.$request->s.'%')->paginate(15);
        }
        else{
            $book = Book::paginate(15);
        }

        return view('admin.book.book', compact('book'));
    }
    public function create()
    {
        $title = 'Добавить книгу';
        $action='/admin/book';
        $authors = Author::where('translator',0)->pluck('name_kz')->toArray();
        $translator = Author::where('translator',1)->pluck('name_kz')->toArray();
        $genres = Genre::all()->pluck('genre_name_ru')->toArray();
        $publishers = Publisher::all();

        return view('admin.book.form' , compact('authors','genres','translator','publishers','action','title'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'book_image' => 'required',
            'book_name' => 'required',
            'book_lang'=> 'required',
            'genre'=> 'required',
            'author'=> 'required',
            'page_quanity'=> 'required',
            'year'=> 'required',
            'cover' => 'required',
            'book_description'=> 'required',
            'publisher_id'=> 'required',
            'mainimg'=>'required'
        ]);

        $book_url = Helpers::getTranslatedSlugRu($request->book_name);

        if(Book::where('book_url',$book_url)->first()){
            $newDate = \DateTime::createFromFormat('U.u', microtime(true));
            $book_url = $book_url.$newDate->format('dmYHis');
        }


        $book = new Book();
        $book->book_name = $request->book_name;
        $book->book_description = $request->book_description;
        $book->audio_file = $request->audio_file;
        $book->ebook_path = $request->ebook;
        $book->fragment_path = $request->fragment;
        $book->book_lang = $request->book_lang;
        $book->isbn = $request->isbn;
        $book->available = $request->available;
        $book->page_quanity = $request->page_quanity;
        $book->paperbook_price = $request->paperbook_price;
        $book->ebook_price = $request->ebook_price;
        $book->audio_price = $request->audio_price;
        $book->year = $request->year;
        $book->cover = $request->cover;
        $book->sale_percentage = $request->sale_percentage;
        $book->book_collection_id = (is_numeric($request->book_collection_id)) ? $request->book_collection_id : null;
        $book->book_url = $book_url;
        $book->publisher_id = $request->publisher_id;

        if($request->has('subscribable')){
            $book->subscribable=$request->subscribable;
        }

        if($request->has('free')){
            $book->free=$request->free;
        }
        if($request->has('free_delivery')){
            $book->free_delivery=$request->free_delivery;
        }

        $book->save();


        //Если ест фотки сохранить фотки
        if ($request->hasFile('book_image')) {
            foreach ($request->file('book_image') as $key=>$item) {
                $path = Helpers::newStoreImg($item,'image',$request);
                BookImages::create([
                    'book_id' => $book->book_id,
                    'path' => $path,
                    'thumbnail180_250' => Helpers::storeThumbnail($path,250,180),
                ]);
            }
        }
        //Главная  обложка
        $main_cover_path = Helpers::newStoreImg($request->mainimg,'image',$request);
        BookImages::create([
            'book_id' => $book->book_id,
            'path' => $main_cover_path,
            'is_main'=>1,
            'thumbnail180_250' => Helpers::storeThumbnail($main_cover_path,250,180),
        ]);

        //Жанр сохранить ету
        if($request->genre) {
            foreach (\App\Http\Helpers::savetags($request->genre) as $item) {
                $genre_id = Genre::where('genre_name_ru', $item)->first()->genre_id;
                BookGenre::create(['bg_book_id' => $book->book_id, 'bg_genre_id' => $genre_id]);
            }
        }
        //Автор сохранить ету
        if($request->author) {
            foreach (\App\Http\Helpers::savetags($request->author) as $item) {
                $author_id = Author::where('name_kz', $item)->first()->id;
                BookAuthor::create(['book_id' => $book->book_id, 'author_id' => $author_id]);
            }
        }
        //Автор сохранить ету
        if($request->translator) {
            foreach (\App\Http\Helpers::savetags($request->translator) as $item) {
                $author_id = Author::where('name_kz', $item)->first()->id;
                BookAuthor::create(['book_id' => $book->book_id, 'author_id' => $author_id, 'is_translator' => 1]);
            }
        }

        if($request->send_push){
            send_push(['id'=>$book->book_id, 'title'=>$book->book_name, 'text'=>'Добавлена новая книга','type'=>'book','image'=>$bookimage->path]);
        }

        return redirect("/admin/book");
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        session(['previous-url' => redirect()->back()->getTargetUrl()]);
        $title = 'Изменить книгу';
        $action='/admin/book/'.$id;
        $authors = Author::where('translator',0)->pluck('name_kz')->toArray();
        $genres = Genre::all()->pluck('genre_name_ru')->toArray();
        $book = Book::find($id);
        $translator = Author::where('translator',1)->pluck('name_kz')->toArray();
        $publishers = Publisher::all();
        return view('admin.book.form', compact('book','authors','genres','translator','publishers','action','title'));
    }
    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        //Главное фото озгертилди
        if ($request->hasFile('mainimg')) {
            BookImages::where('book_id',$id)->where('is_main',1)->delete();

            $path = Helpers::newStoreImg($request->mainimg,'image',$request);
            BookImages::create([
                'book_id' => $id,
                'path' => $path,
                'is_main'=>1,
                'thumbnail180_250' => Helpers::storeThumbnail($path,250,180),
            ]);
        }
        if ($request->has('deletedimage')) {
            foreach($request->deletedimage as $image){
                BookImages::find($image)->delete();
            }
        }
        if ($request->hasFile('book_image')) {
            foreach ($request->file('book_image') as $key=>$item) {
                $path = Helpers::newStoreImg($item,'image',$request);
                BookImages::create([
                    'book_id' => $book->book_id,
                    'path' => $path,
                    'thumbnail180_250' => Helpers::storeThumbnail($path,250,180),
                ]);
            }
        }

        if($request->book_name !=$book->book_name) {
            $book_url = Helpers::getTranslatedSlugRu($request->book_name);
            if ($book_url != $book->book_url) {
                if (\App\Models\Book::where('book_url', $book_url)->where('book_id', '<>', $id)->first()) {
                    $book_url = $book_url . \DateTime::createFromFormat('U.u', microtime(true));
                }
            }
        }
        else{
            $book_url=$book->book_url;
        }

        Book::where('book_id', $id)->update(
            [
                'book_name' => $request->book_name,
                'book_description' => $request->book_description,
                'audio_file' => $request->audio_file,
                'ebook_path' => $request->ebook,
                'fragment_path' => $request->fragment,
                'book_lang' => $request->book_lang,
                'isbn' => $request->isbn,
                'available' => $request->available,
                'page_quanity' => $request->page_quanity,
                'paperbook_price' => $request->paperbook_price,
                'ebook_price' => $request->ebook_price,
                'audio_price' => $request->audio_price,
                'year' => $request->year,
                'cover' => $request->cover,
                'book_url' => $book_url,
                'book_collection_id' => (is_numeric($request->book_collection_id)) ? $request->book_collection_id : null,
                'sale_percentage' => $request->sale_percentage,
                'publisher_id' => $request->publisher_id,
                'subscribable' => $request->has('subscribable')?$request->subscribable:0,
                'free' => $request->has('free')?$request->free:0,
                'free_delivery' => $request->has('free_delivery')?$request->free_delivery:0

            ]
        );

        //Жанр сохранить ету
        if($request->genre) {
            BookGenre::where('bg_book_id', $book->book_id)->delete();
            foreach (Helpers::savetags($request->genre) as $item) {
                $genre_id = Genre::where('genre_name_ru', $item)->first()->genre_id;
                BookGenre::create(['bg_book_id' => $book->book_id, 'bg_genre_id' => $genre_id]);
            }
        }
        // Автор сохранить ету
        if($request->author) {
            BookAuthor::where('book_id', $book->book_id)->delete();
            foreach (Helpers::savetags($request->author) as $item) {
                $author = Author::where('name_kz', $item)->first()->id;
                BookAuthor::create(['book_id' => $book->book_id, 'author_id' => $author]);
            }
        }

        //Автор сохранить ету
        if($request->translator) {
            foreach (Helpers::savetags($request->translator) as $item) {
                $author_id = Author::where('name_kz', $item)->first()->id;
                BookAuthor::create(['book_id' => $book->book_id, 'author_id' => $author_id, 'is_translator' => 1]);
            }
        }

        return redirect(session('previous-url'));;
    }
    public function destroy($id)
    {
        if(UserBooks::where('ub_book_id',$id)->first()){
            return ['error'=>'Книга уже куплена у какого-то юзера.  Надо сначало удалить у него книгу.'];
        }
        else{
            $book = Book::find($id);
            $book->delete();
            BookGenre::where('bg_book_id',$id)->delete();
            BookAuthor::where('book_id',$id)->delete();
        }
    }
    public function temporarly(){
        $books = Book::all();
        foreach ($books as $book){
            if($book->book_description[0]!='<'){
                $book->book_description='<p>'.$book->book_description.'</p>';
                $book->save();
            }
        }
    }
    public function archive(Request $request){
        Book::find($request->book_id)->update(['in_archive'=>$request->status]);
        return back();
    }
    public function changPercentage(Request $request,$book_id){
        Book::find($book_id)->update(['sale_percentage'=>$request->percentage]);
        return back();
    }
}
