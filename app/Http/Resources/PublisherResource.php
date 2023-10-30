<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PublisherResource extends ResourceCollection
{
    private $lang;

    public function __construct( $resource, $lang)
    {
        parent::__construct($resource);
        $this->resource = $resource;
        $this->lang = $lang;
    }
    public function toArray($request)
    {
        return $this->collection->transform(function($publisher){
            return [
                'id' => $publisher->id,
                'name' => $publisher['name_'.$this->lang],
            ];
        });

    }
}