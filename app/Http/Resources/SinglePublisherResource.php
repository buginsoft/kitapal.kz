<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\BookShortInfoResource;

class SinglePublisherResource extends JsonResource
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
            'name_kz' => $this['name_'.$this->lang],
            'description_ru' => $this['description_'.$this->lang],
            'photo' => url('/') .$this->photo,
            'vk' => $this->vk,
            'instagram' => $this->instagram,
            'telegram' => $this->telegram,
            'facebook' => $this->facebook,
            'twitter' => $this->	twitter,
            'source_kz' => $this->source_kz,
            'books'=>new BookShortInfoResource(null,$this->books)
        ];

    }
}
