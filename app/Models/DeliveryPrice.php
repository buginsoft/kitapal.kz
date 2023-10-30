<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryPrice extends Model
{
    protected $table = 'delivery_price';
    protected $guarded = ['id'];
    public $timestamps=false;

}
