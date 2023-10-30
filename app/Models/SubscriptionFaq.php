<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionFaq extends Model
{
    public $table = 'subscription_faq';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function content()
    {
        return $this->morphOne(\App\Models\Content::class, 'contentable');
    }
}
