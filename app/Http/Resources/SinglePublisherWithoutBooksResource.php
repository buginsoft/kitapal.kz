<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\BookShortInfoResource;

class SinglePublisherWithoutBooksResource extends JsonResource
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
        return [
            'id' => $this->id,
            'name' => $this['name_'.$this->lang],
        ];

    }
}
