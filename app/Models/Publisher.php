<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Book;

class Publisher extends Model
{
    protected $table = 'publishers';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function books()
    {
        return $this->hasMany('App\Models\Book' ,'publisher_id');
    }
}
