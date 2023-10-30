<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBooks extends Model
{
    protected $primaryKey = 'ub_id';
    protected $guarded = [];

    public function book()
    {
        return $this->belongsTo('App\Models\Book','ub_book_id');
    }


}
