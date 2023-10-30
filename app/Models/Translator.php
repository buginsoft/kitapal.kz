<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Translator extends Model
{
    protected $table = 'translators';
    protected $guarded = ['id'];
    public $timestamps=false;

}
