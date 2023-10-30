<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\BookShortInfoResource;

class SingleAuthorResource extends JsonResource
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
            'author_photo' => url('/') .$this->author_photo,
            'description' => $this['description_'.$this->lang],
            'name' => $this['name_'.$this->lang],
            'telegram' => $this->telegram,
            'facebook' => $this->facebook,
            'twitter' => $this->	twitter,
            'source' => $this['source_'.$this->lang],
            'books'=>new BookShortInfoResource(null,$this->books)
        ];

    }
}
