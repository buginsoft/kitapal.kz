<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SinglePublisherWithoutBooksResource;
use App\Http\Resources\BookShortInfoResource;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\GenreResource;
use App\Http\Resources\FeedbackResource;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\UserBooks;
use App\Models\Publisher;
use App\Models\UserSelected;
use JWTAuth;

class SubscriptionArrayResource extends JsonResource
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

        if($this->resource) {
            return
                [
                    'id' => $this->subscription->id,
                    'title' => $this->subscription["title_$this->lang"],
                    'name' => $this->subscription["name_$this->lang"],
                    'description' => $this->subscription['description_' . $this->lang],
                    'months' => $this->subscription->months,
                    'price' => $this->subscription->price
                ];
        }
        else
            return  null;
    }
}
