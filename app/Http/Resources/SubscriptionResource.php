<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\Subscription;
class SubscriptionResource extends ResourceCollection
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
        return $this->collection->transform(function ($subs) {


            return
                [
                    'id' => $subs->id,
                    'title' => $subs['title_' . $this->lang],
                    'name' => $subs['name_' . $this->lang],
                    'description' => $subs['description_' . $this->lang],
                    'months' => $subs->months,
                    'price' => $subs->price,
                    'card_colour'=> $subs->card_colour??'#ECF9FF' ,
                    'button_colour'=>  $subs->button_colour,
                    'post'=> $subs->post_image?url('').$subs->post_image:null,

                ];
        });
    }





}
