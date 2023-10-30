<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Book;

class CheckPricechange2 implements Rule
{
    public $books;
    public $prices;
    public $text=[];
    public $realprices;

    public function __construct($books_prices_array,$books,$prices)
    {
        $this->realprices = $books_prices_array;
        $this->books = $books;
        $this->prices = $prices;
        //dd($books);
    }

    public function passes($attribute, $value)
    {

       // array_push($this->realprices,0);
        //array_push($this->prices,0);
        $i=0;
        foreach ($this->books as $item) {
            if($this->realprices[$i]!=$this->prices[$i]){
                array_push($this->text,\App\Models\Book::find($this->books[$i]['attributes']['book_id'])->book_name);
            }
            $i++;
        }
        if(count($this->text)){
            return false;
        }
        else{
            return true;
        }

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Цена   изменился: '. implode(",", $this->text);
    }
}
