<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    protected $table = 'order_products';
    protected $guarded = ['id'];
    public $timestamps = false;


    public function book()
    {
        return $this->belongsTo('App\Models\Book','product_id');
    }
    public function order()
    {
        return $this->hasOne('App\Models\CustomerOrder','order_id');
    }
}
