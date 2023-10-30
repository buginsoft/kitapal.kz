<?php

namespace App\Models;

use App\Models\UserSelected;
use Illuminate\Database\Eloquent\Model;
use Cart;

class BookImages extends Model
{
    protected $table = 'book_images';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps =false;

    public function getPathAttribute($value)
    {

        return url('/')  . $value;
    }

   
}
