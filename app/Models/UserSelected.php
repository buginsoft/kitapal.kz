<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSelected extends Model
{
    protected $table = 'user_selecteds';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function book()
    {
        return $this->belongsTo('App\Models\Book','book_id');
    }
}
