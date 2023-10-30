<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\AuthorResource;
use App\Models\UserSelected;

class BookShortInfoResource extends ResourceCollection
{
    public $user_id;
    public function __construct($user_id ,$resource)
    {
        parent::__construct($resource);
        $this->resource = $resource;
        $this->user_id = $user_id;
    }

    public function toArray($request)
    {
        return $this->collection->transform(function ($book) {

            $result = [
                'id' => $book->book_id,
                'name' => $book->book_name,
                'book_image' => $book->main_image()->path,
                'selected' => $book->is_selected($this->user_id),
                'available' => $book->available,
                'sale_percentage' => $book->sale_percentage,
                'book_lang' => $book->book_lang,
                'author' => new AuthorResource($book->authors),
                'pay_type' => $book->subscribable?'subscribe':'buy',
            ];

            if (!is_null($book->paperbook_price)) {
                $result['paperbook_price']=$book->paperbook_price;
            }
            if (!is_null($book->audio_price)) {
                $result['audio_price']=$book->audio_price;
            }
            if (!is_null($book->ebook_price)) {
                $result['ebook_price']=$book->ebook_price;
            }

            return $result;

        });
    }
}

