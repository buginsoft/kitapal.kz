<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerOrder extends Model
{
    protected $table = 'customer_order';
    protected $primaryKey = 'order_id';
    protected $guarded = ['order_id'];

    public function books()
    {
        return $this->belongsToMany('App\Models\Book','order_products','order_id','product_id')->withPivot('type');
    }
    public function order_products() {
        return $this->hasMany('App\Models\OrderProducts','order_id','order_id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
    public function user_subscription()
    {
        return $this->belongsTo('App\Models\UserSubscription','subscription_id');
    }
    public function status()
    {
        return $this->belongsTo('App\Models\OrderStatus','status_id');
    }

    public function products()
    {
        return $this->hasMany('App\Models\OrderProducts','order_id');
    }
    public function address(){
        return $this->belongsTo('App\Models\OrderAddress','address_id');
    }
    public function promocode(){
        return $this->belongsTo('App\Models\Promocodes','promocode_id');
    }

    public function getPostPrice($total_price){
        $deliveryprice=\App\Models\DeliveryPrice::where('type','почта')->where('description','0-2500')->first()->price;

        if($total_price>2501 and  $total_price<5000){
            $deliveryprice=\App\Models\DeliveryPrice::where('type','почта')->where('description','2501-5000')->first()->price;
        }
        else if($total_price>5001 and $total_price<9990){
            $deliveryprice=\App\Models\DeliveryPrice::where('type','почта')->where('description','5001-9989')->first()->price;
        }
        else if($total_price>9989 and $total_price<14999){
            $deliveryprice=\App\Models\DeliveryPrice::where('type','почта')->where('description','9990-14999')->first()->price;
        }
        else if($total_price>15000){
            $deliveryprice=0;
        }
        return $deliveryprice;
    }
    public function order_product($book)
    {
        return \App\Models\OrderProducts::where([
            ['product_id',$book->book_id],
            ['order_id',$this->order_id]])->first();
    }
}
