<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
    public function subscription()
    {
        return $this->belongsTo('App\Models\Subscription','subscription_id');
    }

    public function scopeFilter($query,$request)
    {
        if ($request->has('type')) {
            if ($request->type == 0) {
                $query->whereDate('final_date', '<', now());
            }
            elseif ($request->type == 1) {
                $query->whereDate('final_date', '>', now());
            }

        }
        if ($request->has('user_name')) {
                $query->whereHas('user', function($query) use ($request){
                    $query->where('user_name', $request->user_name);
                });

        }
    }
}
