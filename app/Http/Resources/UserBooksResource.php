<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\AuthorResource;
use App\Models\User;

class UserBooksResource extends ResourceCollection
{
    private $lang;
    private $user_id;
    private $paper=[];
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
        $user = User::find($this->user_id);

        if(is_null($this->type)) {
            $this->collection->transform(function ($book) {
                foreach ($book->products as $item) {
                    if ($item->type == 'paper') {
                        $collection = $item->book->collection ? $item->book->collection["collection_name_$this->lang"] : '';
                        array_push($this->paper, [
                            'book_id' => $item->book['book_id'],
                            'book_name' => $item->book['book_name'],
                            'book_image' => url('/') . $item->book['book_image'],
                            'book_description' => $item->book['book_description'],
                            'book_collection' => $collection,
                            'authors' => new AuthorResource($item->book->authors),
                        ]);
                    }
                }
            });
        }

        $books = $this->type=='my_subscription'?$this->resource:$user->books;
        
        foreach($books as $item){
            if($item->pivot->type=='ebook'){
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
            if($item->pivot->type=='audio'){
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

        $result = [
            'success'=>true,
            'user_id' => $this->user_id,
            'paper'=>$this->paper,
            'ebook'=>$this->ebook,
            'audio'=>$this->audio
        ];
        return $result;
    }
}
