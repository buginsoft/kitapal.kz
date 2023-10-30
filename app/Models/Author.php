<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'author';
    protected $guarded = ['id'];
    public $timestamps=false;

    public function books()
    {
        return $this->belongsToMany('App\Models\Book', 'book_authors', 'author_id', 'book_id');
    }
}
