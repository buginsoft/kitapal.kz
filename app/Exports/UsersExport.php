<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class UsersExport implements FromArray,WithHeadings,WithColumnWidths
{
    protected $range;

    function __construct($range) {
        $this->range = $range;
    }
    public function array(): array
    {
        $result = [];

        foreach(User::with('address')->with('orders')->with('address.citytitle')->with('orders.products')->with('orders.products.book')->
            orderBy('user_id')->
        whereBetween('user_id',[$this->range-15000,$this->range])->get() as $user){
            $address = '';
            if($user->address){
                $city = '';
                if($user->address->citytitle){
                    $city = $user->address->citytitle->text_kz;
                }
                $address = $city.','.$user->address->street.','.$user->address->home.','.$user->address->podezd.','.$user->address->kvartira.','.$user->address->naselenny_punkt.','.$user->address->post_index;
            }

            $orders = '';
            if($user->orders){
                $orders = '';
                foreach ($user->orders as $order){
                    foreach($order->products as $order_product){
                        if($order_product->book) {
                            $orders = $orders . $order_product->book->book_name . ',';
                        }
                    }
                }
            }
            array_push($result,[
                $user->user_id,
                $user->email,
                $user->phone,
                $user->user_name,$address,$orders
            ]);
        }

        return $result;
    }

    public function headings(): array
    {
        return ['id',"Почта", "Телефон", "Имя",'Адрес','Заказы'];
    }
    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 30,
            'C' => 15,
            'D' => 13,
            'E' => 50,
            'F' => 150,
        ];
    }
}
