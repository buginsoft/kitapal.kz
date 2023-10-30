<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;


class SliderResource extends ResourceCollection
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
            ->transform(function($slider) {
                $item_id= explode('/',$slider['url']);
                $result = [
                    'slider_image' => url('/').$slider->slider_image,
                    //'id' => $item_id[2],
                    'slider_header'=>'',
                    'slider_text'=>'',
                    'button_text'=>'',
                    'type'=>$slider->type,
                    'book_id'=>$slider->book_id
                ];
                if($slider->type=='book'){
                    $book=\App\Models\Book::find($slider->book_id);
                    $result['book_name']=$book->book_name;
                    $result['book_image']=url('/').$book->main_image()->path;
                    $result['id']=$slider->book_id;
                }
                if($slider->type=='catalog'){
                    $catalog=\App\Models\Genre::find($slider->catalog_id);
                    if(!$catalog){
                      //  dd($slider->catalog_id);
                    }
                    $result['genre_name']=$catalog['genre_name_'.$this->lang];
                    $result['id']=$slider->catalog_id;
                }

                if($slider->type=='collection'){

                    $catalog=\App\Models\Collection::find($slider->collection_id);
                    if(!$catalog){
                        dd($slider->collection_id);
                    }
                    
                    $result['genre_name']=$catalog['collection_name_'.$this->lang];
                    $result['id']=$slider->collection_id;
                }

                return $result;
            });
    }
}
