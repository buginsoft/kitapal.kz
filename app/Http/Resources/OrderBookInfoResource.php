<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\GenreResource;
use App\Http\Resources\FeedbackResource;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class OrderBookInfoResource extends JsonResource
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
            'book_id' => $this->book_id,
            'book_name' => $this->book_name,
            'book_cover' => $this->main_image()->path,
            'author' => new AuthorResource($this->authors),
            'type'=> $this->pivot->type
        ];
    }
}
