<?php

namespace App\Models;

use App\Models\UserSelected;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cart;

class Book extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'book_id';
    protected $guarded = [];

    public function images(){
        return $this->hasMany('App\Models\BookImages' , 'book_id')->orderBy('is_main','desc');
    }
    public function main_image2(){
        return $this->hasMany('App\Models\BookImages' , 'book_id')->where('is_main',1);

    }
    public function main_image3(){
        return $this->hasOne('App\Models\BookImages' , 'book_id')->where('is_main',1);

    }




    public function main_image(){
      return \App\Models\BookImages::where([['book_id',$this->book_id],['is_main',1]])->first();
    }
    public function genres()
    {
        return $this->belongsToMany('App\Models\Genre', 'book_genres', 'bg_book_id', 'bg_genre_id');
    }
    public function authors()
    {
        return $this->belongsToMany('App\Models\Author', 'book_authors', 'book_id', 'author_id')->where('is_translator',0);
    }
    public function translators()
    {
        return $this->belongsToMany('App\Models\Author', 'book_authors', 'book_id', 'author_id')->where('is_translator',1);
    }
    public function feedbacks()
    {
        return $this->hasMany('App\Models\Feedback' , 'book_id')->orderBy('created_at','desc');
    }
    public function collection()
    {
        return $this->belongsTo('App\Models\Collection' , 'book_collection_id');
    }

    public function collection2()
    {
        return $this->hasMany('App\Models\Collection' , 'book_collection_id','collection_id');
    }

    public function publisher()
    {
        return $this->belongsTo('App\Models\Publisher' , 'publisher_id');
    }
    public function addToSelected($user_id,$book_id){
        try {
            UserSelected::where([['user_id' , $user_id],['book_id', $book_id]])->firstOrFail()->delete();
            return ['status'=>'true','action'=>'delete'];
        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $selected = UserSelected::create(['user_id' => $user_id, 'book_id' => $book_id]);
            return $selected?['status'=>'true','action'=>'add']:'false';
        }
    }

    public function addBookToBasket($book_id,$type){
        if(\Auth::user()){
            Cart::session(\Auth::user()->user_id);
        }
        else{
            Cart::session(session()->getId());
        }

        $items = Cart::getContent();
        $exist = false;
        $lastindex = 0;
        $book  = \App\Models\Book::find($book_id);
        $id = 1;
        $on_sale=0;


        if($type == 'paper'){
            $price =$book->paperbook_price;

        }
        else if($type == 'ebook'){
            $price =$book->ebook_price;
        }
        else{
            $price =$book->audio_price;
        }

        if($book->sale_percentage>0){
            $price =$price*(100-$book->sale_percentage)/100;
            $on_sale=1;
        }

        if(!$items->isEmpty()) {
            foreach ($items as $key => $item) {

                if ($item->attributes->book_id == $book_id && $item->attributes->type == $type) {
                    $id = $item->id;

                    Cart::update($item->id, array(
                        'quantity' => 1
                    ));
                    $exist = true;

                    return Cart::get($id);
                }
                //Записываем последний индекс элементов корзины
                if ($items->last() == $item) {
                    $lastindex = $item->id;
                }
            }
        }

        //Если нет а базе
        if (!$exist) {
            $id = $lastindex+1;
        }

        Cart::add(array(
            'id' => $id,
            'name' => $book->book_name,
            'price' => $price,
            'quantity' => 1,
            'attributes' => ['book_id' => $book_id, 'type' => $type, 'on_sale' => $on_sale],
        ));

        return Cart::get($id);
    }



    public function selected()
    {
        return $this->belongsToMany('App\Models\User', 'user_selecteds', 'book_id', 'user_id');
    }

    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utilities\BookFilters';
        $filter = new \App\Utilities\FilterBuilder($query, $filters, $namespace);

        return $filter->apply();
    }
    public function is_selected($user_id=null)
    {
        if(is_null($user_id)){
            return false;
        }
        else{
            return UserSelected::where([['book_id',$this->book_id],['user_id',$user_id]])->count()>0;
        }
        //return $this->belongsToMany('App\Models\User', 'user_selecteds', 'book_id', 'user_id');
    }
    public function getPrice($type)
    {
        if($type=='paper'){
            $price = $this->paperbook_price;
        }
        elseif($type=='ebook'){
            $price = $this->ebook_price;
        }
        else{
            $price = $this->audio_price;
        }
        if ($this->sale_percentage > 0) {
            return $price * (100 - $this->sale_percentage) / 100;
        } else {
            return $price;
        }
    }
    public function now_reading_book(){
        return $this->belongsToMany('App\Models\User','now_reading_table','book_id','user_id');
    }
}
