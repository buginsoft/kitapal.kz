<?php

namespace App\Http\Controllers\API;

use App\Classes\Robokassa;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubscriptionResource;
use App\Models\CustomerOrder;
use App\Models\Subscription;
use App\Models\UserSubscription;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{

    public function getsubscriptions(Request $request)
    {
        return new SubscriptionResource(Subscription::orderBy('sort_num')->get(), $request->lang);
    }

    public function buysubscription(Request $request)
    {
        $user = auth()->guard('api')->user();
        $subscription = Subscription::query()->find($request->subscription_id);

        $user_sub = UserSubscription::query()->create([
            'user_id' => $user->user_id,
            'subscription_id' => $request->subscription_id,
            'final_date' => Carbon::now()->addMonths($subscription->months)
        ]);

        $order = CustomerOrder::query()->create([
            'user_id' => $user->user_id,
            'is_delivered' => 0,
            'total' => $subscription->price,
            'subscription_id' => $user_sub->id
        ]);

        $user_sub->update([
            'recurring' => $request->recurring,
            'debiting_date' => Carbon::now()->addMonths($subscription->months)
        ]);

        $payment = new Robokassa;
        return ['fields' => $payment->getLink($subscription->price, $order->order_id, $request->recurring)];
    }
}
