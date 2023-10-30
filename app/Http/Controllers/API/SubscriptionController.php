<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubscriptionResource;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{

    public function getsubscriptions(Request $request)
    {
        return new SubscriptionResource( Subscription::orderBy('sort_num')->get(),$request->lang) ;
    }

    public function buysubscription(Request $request)
    {
        $user = auth()->guard('api')->user();
        $subscription = Subscription::find($request->subscription_id);

        $user_sub = \App\Models\UserSubscription::create([
            'user_id' => $user->user_id,
            'subscription_id' => $request->subscription_id,
            'final_date' => \Carbon\Carbon::now()->addMonths($subscription->months)
        ]);

        $order = \App\Models\CustomerOrder::create([
            'user_id' => $user->user_id,
            'is_delivered' => 0,
            'total' => $subscription->price,
            'subscription_id' => $user_sub->id
        ]);
        return ['fields' => getPaymentLink($subscription->price ,  $order->order_id)];
    }
}
