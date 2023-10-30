<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promocodes extends Model
{


    protected $table='promocodes';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function used_quantity(){
        return \App\Models\CustomerOrder::where([
            ['promocode_id',$this->id],
            ['status_id' , 1]
        ])->count();
    }
}
