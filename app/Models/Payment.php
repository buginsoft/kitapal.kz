<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $guarded = [];

    public function books_total_price($books,$booktypes,$bookquantity){
        $books_total_price=0;
        $books_prices_array=[];

        foreach ($books as $key => $item) {
            $book=Book::find($books[$key]);
            if($booktypes[$key]=='paper'){
                $books_price=$book->paperbook_price -($book->paperbook_price*$book->sale_percentage)/100;
            }
            elseif($booktypes[$key]=='ebook'){
                $books_price=$book->ebook_price -($book->ebook_price*$book->sale_percentage)/100;
            }
            elseif($booktypes[$key]=='audio'){
                $books_price=$book->audio_price -($book->audio_price*$book->sale_percentage)/100;
            }
            array_push($books_prices_array,$books_price);

            $books_total_price+=$bookquantity[$key]*$books_price;
        }

        return ['total_price'=>$books_total_price , 'prices_array'=>$books_prices_array];
    }
    public function books_total_price2($cart){

        $books_total_price=0;
        $books_prices_array=[];

        foreach ($cart as $item) {
            $book=Book::find($item['attributes']['book_id']);
            if($item['attributes']['type']=='paper'){
                $books_price=$book->paperbook_price -($book->paperbook_price*$book->sale_percentage)/100;
            }
            elseif($item['attributes']['type']=='ebook'){
                $books_price=$book->ebook_price -($book->ebook_price*$book->sale_percentage)/100;
            }
            elseif($item['attributes']['type']=='audio'){
                $books_price=$book->audio_price -($book->audio_price*$book->sale_percentage)/100;
            }
            array_push($books_prices_array,$books_price);

            $books_total_price+=$item['quantity']*$books_price;
        }
        return ['total_price'=>$books_total_price , 'prices_array'=>$books_prices_array];
    }
}
