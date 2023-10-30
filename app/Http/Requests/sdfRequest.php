<?php

namespace App\Http\Requests;


use App\Rules\CheckPricechange2;
use App\Rules\checkTotalprice2;
use Illuminate\Foundation\Http\FormRequest;


class sdfRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return \Auth::check();
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $payment = new  \App\Models\Payment;
        $detailes = $payment->books_total_price2(\Cart::session(session()->getId())->getContent());
        $books_total_price=$detailes['total_price'];
        $books_prices_array=$detailes['prices_array'];

        $result = [];

        if(!$this->has('is_gift')){
            $result['price'] = [new CheckPricechange2($books_prices_array, $this->book, $this->prices), new checkTotalprice2($books_total_price)];
        }

        //Если это бумажная книга
        if ($this->has('delivery_type')) {
            if($this->delivery_type!='pickup'){
                $result['phone'] = 'required';
                $result['fio']='required';
                $result['city']='required';
            }
            else{
                $result['phone'] = 'required';
                $result['fio']='required';
            }
        }
        //электронный или подарок
        else{
            //Если подарок
            if ($this->has('is_gift'))
            {
                $result['recipient_name'] = 'required';
                $result['recipient_email'] = 'required';
            }
            else {
                $result['phone'] = 'required';
                $result['fio'] = 'required';
            }
        }
        return $result;
    }
}
