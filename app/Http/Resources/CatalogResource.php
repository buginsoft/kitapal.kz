<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;


class CatalogResource extends ResourceCollection
{
    private $lang;

    public function __construct($resource, $lang)
    {
        parent::__construct($resource);
        $this->resource = $resource;
        $this->lang = $lang;
    }
    public function toArray($request)
    {
        return $this->collectResource($this->collection)
            ->transform(function($book){
                return [
                    'book_id' => $book->book_id,
                    'book_name' => $book->book_name,
                    'price' => $book->paperbook_price,
                    'available'=>$book->available,
                    'sale_percentage'=>$book->sale_percentage,
                    'price_with_sale'=>$book->paperbook_price*((100-$book->sale_percentage)/100),
                    'book_image' => asset($book->images->where('is_main',1)->first()->path),
                    'author'=>new AuthorResource($book->authors),
                    'collection' => $book->collection?$book->collection["collection_name_".$this->lang]:'',
                    'pay_type' => $book->subscribable?'subscribe':'buy',
                ];
            });
    }
}
