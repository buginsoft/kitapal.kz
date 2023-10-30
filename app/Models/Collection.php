<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $primaryKey = 'collection_id';
    protected $guarded = [];

    public function books()
    {
        return $this->hasMany('App\Models\Book', 'book_collection_id', 'collection_id')->where('in_archive',0);
    }
}
