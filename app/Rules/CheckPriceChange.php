<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Book;

class CheckPriceChange implements Rule
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
    }

    public function passes($attribute, $value)
    {

        $i=0;
        foreach ($this->books as $item) {
            if($this->realprices[$i]!=$this->prices[$i]){
                array_push($this->text,\App\Models\Book::find($item['attributes']['book_id'])->book_name);
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
