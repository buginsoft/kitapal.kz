<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $primaryKey = 'slider_id';
    protected $guarded = [];

    public function book(){
        return $this->belongsTo('\App\Models\Book','book_id');
    }
}
