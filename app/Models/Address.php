<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'user_address';
    protected $guarded = [];

    public function citytitle()
    {
        return $this->belongsTo('App\Models\City','city');
    }
}
