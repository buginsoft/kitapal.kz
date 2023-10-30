<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    public $table = 'content';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function contentable()
    {
        return $this->morphTo();
    }
}
