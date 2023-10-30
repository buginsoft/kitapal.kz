<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GenreResource extends ResourceCollection
{
    private $lang;
    public function __construct($resource, $lang){
        parent::__construct($resource);
        $this->resource = $resource;
        $this->lang = $lang;
    }
    public function toArray($request)
    {
        return $this->collection->transform(function($author) {
            return [
                'genre_id' => $author->genre_id,
                'name' => $author['genre_name_'.$this->lang]
            ];
        });

    }
}
