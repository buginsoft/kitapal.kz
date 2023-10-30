<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSubscriptionReading extends Model
{
    public  $table='user_subscription_reading';
    protected $primaryKey = 'id';
    protected $guarded = [];
    
}
