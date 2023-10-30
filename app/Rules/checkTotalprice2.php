<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Book;

class checkTotalprice2 implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $bookprices;
    public function __construct($books_total_price)
    {
        $this->bookprices=$books_total_price;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //dd($value);
        return intval($value)==$this->bookprices;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Сумма цен книг не соответсвует итоговой цене';
    }
}
