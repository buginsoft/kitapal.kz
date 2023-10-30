<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;


class CollectionResource extends ResourceCollection
{
    private $user_id;

    public function __construct($user_id ,$lang, $resource)
    {
        parent::__construct($resource);
        $this->resource = $resource;
        $this->user_id = $user_id;
        $this->lang = $lang;
    }
    public function toArray($request)
    {
        return $this->collectResource($this->collection)
            ->transform(function($collection)  use ($request)  {

                if($request->has('type')) {
                    if ($request->type == 'ebook') {
                        $books =$collection->books()->where($request->type.'_path','<>',null);
                    } elseif ($request->type == 'audio') {
                        $books=$collection->books()->where($request->type.'_file','<>',null);
                    }
                }
                else{
                    $books=$collection->books();
                }

                return  [
                    'color' => $collection->color,
                    'icon' => url('/').$collection->icon,
                    'collection_name' => $collection['collection_name_'.$this->lang],
                    'books' => new \App\Http\Resources\BookShortInfoResource($this->user_id,$books->inRandomOrder()->take(15)->get())
                ];
            });
    }
}
