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
use App\Models\User;

class Book extends JsonResource
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
        $headers = apache_request_headers();
        if(isset( $headers['authorization']) || isset( $headers['Authorization'])) {
            $user = auth()->guard('api')->user();
            $user_id=$user->user_id;
        }
        else{
            $user_id=null;
        }
        if ($this->feedbacks->count() > 0) {
            $rating = $this->feedbacks->sum('rating') / $this->feedbacks->count();
        } else {
            $rating = 0;
        }
        $user_subscribed = $user_id?$user->subscription:0;

        $result = [
            'book_id' => $this->book_id,
            'book_name' => $this->book_name,
            'book_image' => url('/').$this->book_image,
            'pay_type' => $this->subscribable?'subscribe':'buy',
            'book_images' => $this->images,
            'book_description' => $this->book_description,
            'book_lang' => $this->book_lang,
            'isbn' => $this->isbn,
            'available' => $this->available,
            'year' => $this->year,
            'publisher'=> new SinglePublisherWithoutBooksResource(Publisher::find($this->publisher_id),$this->lang),
            'page_quanity' => $this->page_quanity,
            'paperbook_price' => $this->paperbook_price,
            'ebook_price' => $this->ebook_price,
            'audio_price' => $this->audio_price,
            'author' => new AuthorResource($this->authors),
            'genres' => new GenreResource($this->genres,$this->lang),
            'feedbacks'=>new FeedbackResource($this->feedbacks),
            'rating'=>$rating,
            'more_book'=>new BookShortInfoResource($user_id,$this->genres[0]->setimchitayut()->take(15)->get()),
            'share' =>url('/').'/book/'.$this->book_url,
            'user_subscribed' =>$user_subscribed
        ];

        if($this->sale_percentage>0) {
            $result['sale_paperbook_price'] = ($result['paperbook_price'] * (100 - $this->sale_percentage)) / 100;
            $result['sale_ebook_price'] = ($result['ebook_price'] * (100 - $this->sale_percentage)) / 100;
            $result['sale_audio_price'] = ($result['audio_price'] * (100 - $this->sale_percentage)) / 100;
            if ($this->lang == 'kz'){
                $result['text'] ='*Мобильды қосымша арқылы тапсырыс берген кезде 5% жеңілдік алыңыз.';
            }
            else{
                $result['text'] = '*При заказе в мобильном приложений  получите скидку на 5%.';
            }
        }
        if(!is_null($this->fragment_path) && !empty($this->fragment_path)){
            $result['fragment_path'] = $this->fragment_path;
        }
        $result["is_giftable"] = !is_null($this->ebook_path)?1:0;

       // $headers = apache_request_headers();
        if(isset( $headers['authorization']) || isset( $headers['Authorization'])) {
            $result['user_id']=$user_id;

                if (check_access(User::find($user_id),$this->book_id)['success']) {
                    $result['ebook_path'] = $this->ebook_path;
                }
                if (check_access_audio(User::find($user_id),$this->book_id)['success']) {
                    $result['audio_file'] = $this->audio_file;
                    $result['audio_size'] = $this->audio_size;
                    $result['audio_length'] = $this->audio_length;
                }
                if (in_array("paper", UserBooks::where([['ub_user_id', $user_id],['ub_book_id', $this->book_id]])->pluck('type')->toArray())) {
                    $result['paper_bought'] = true;
                }

            $result['selected']=(UserSelected::where([['user_id',$user_id],['book_id',$this->book_id]])->first())?true:false;
        }
        return $result;
    }
}
