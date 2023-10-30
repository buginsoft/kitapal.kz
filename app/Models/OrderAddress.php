<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    protected $table = 'order_address';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function citytitle()
    {
        return $this->belongsTo('App\Models\City','city');
    }
}
