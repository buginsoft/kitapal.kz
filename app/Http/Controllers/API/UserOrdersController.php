<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\AuthorResource;

class UserOrdersController extends Controller
{
    protected $data = [
        'user_book_list' => [],
        'isreading' => [],
    ];
    protected   $user ;

    public function __construct()
    {
        $this->user = auth()->guard('api')->user();
    }

    public function start(Request $request)
    {
        $user_id = $this->user->user_id;

        foreach ($this->user->user_books()->whereIn('type', ['ebook','audio'])->get() as $user_book) {

            if (isset($user_book->book)) {
                $book  = $user_book->book;
                if($request->lang === 'ru'){
                    $this->name_universal=$book->authors->pluck('name_ru');
                    $this->result = implode('; ', $this->name_universal->toarray());
                }
                if($request->lang === 'kz'){
                    $this->name_universal=$book->authors->pluck('name_kz');
                    $this->result = implode('; ', $this->name_universal->toarray());
                }
                $arr = [
                    'type' => $user_book->type,
                    'book_name' => $book->book_name,
                    'book_id' => $book->book_id,
                    'images' => $book->main_image()->path,
                    'ebook_path'=>$book->ebook_path,
                    'audio_file'=>$book->audio_file,
                    'color'=>$book->collection ?$book->collection->color : '',
                    'icon'=>$book->collection ? $book->collection->icon : '',
                    'authors' =>  new AuthorResource($book->authors),
                    'book_collection' => $book->collection ? $book->collection->collection_name_ru : '',
                    'user_selected' => $book->is_selected($user_id)
                ];
                $this->data['user_book_list'][] = $arr;
            }
        }

        foreach ($this->user->now_reading_book()->where('finish', 0)->where('subscription', 0)->get() as $reading_book) {
            $arr2 = [
                'type' => 'ebook',
                'book_name' => $reading_book->book_name,
                'book_id'=>$reading_book->book_id,
                'images' => $reading_book->main_image()->path,
                'ebook_path'=>$reading_book->ebook_path,
                'audio_file'=>$reading_book->audio_file,
                'color'=>$reading_book->collection ?$reading_book->collection->color : '',
                'icon'=>$reading_book->collection ? $reading_book->collection->icon : '',
                'authors' =>new AuthorResource($reading_book->authors),
                'book_collection' => $reading_book->collection ? $reading_book->collection->collection_name_ru : '',
                'user_selected' => $reading_book->is_selected($user_id)
            ];
            $this->data['isreading'][] = $arr2;
        }
        return $this->data;
    }
}






































































































































































































































































































