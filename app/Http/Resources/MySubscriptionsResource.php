<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\AuthorResource;
use App\Models\User;

class MySubscriptionsResource extends ResourceCollection
{
    private $lang;
    private $user_id;
    private $ebook=[];
    private $audio=[];
    private $type;

    public function __construct($resource, $lang,$user_id,$type=null)
    {
        parent::__construct($resource);
        $this->resource = $resource;
        $this->lang = $lang;
        $this->user_id = $user_id;
        $this->type=$type;

    }
    public function toArray($request)
    {
        foreach($this->resource as $item){
            if(!is_null($item->ebook_path)){
                $collection = $item->collection?$item->collection["collection_name_$this->lang"]:'';
                array_push($this->ebook, [
                    'book_id' => $item->book_id,
                    'book_name' => $item->book_name,
                    'book_image' => url('/') . $item->book_image,
                    'book_description' => $item->book_description,
                    'ebook_path' => $item->ebook_path,
                    'book_collection' =>$collection,
                    'authors' => new AuthorResource($item->authors),
                ]);

            }
            if(!is_null($item->audio_path)){
                $collection = $item->collection?$item->collection["collection_name_$this->lang"]:'';
                array_push($this->audio,[
                    'book_id'=>$item->book_id,
                    'book_name'=>$item->book_name,
                    'book_image'=>url('/').$item->book_image,
                    'book_description'=>$item->book_description,
                    'audio_file'=>$item->audio_file,
                    'book_collection'=>$collection,
                    'authors'=>new AuthorResource($item->authors),
                    'share'=>url('/').'/book/'.$item->book_id,
                ]);
            }
        }
        return  [
            'success'=>true,
            'user_id' => $this->user_id,
            'ebook'=>$this->ebook,
            'audio'=>$this->audio
        ];
    }
}
