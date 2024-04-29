<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Http\Request;
use App\Models\UserSubscription;
use App\Models\Subscription;

class UserSubscriptionController extends Controller
{

    protected $data = [
        'user_subscription_list' => [],
        'days_untill_the_end' => [],
    ];

    public function start()
    {
        $user_id = (auth()->guard('api')->user()->user_id);
        $user_subscription = UserSubscription::where('user_id', $user_id)
            ->where('active', 1)
            ->get();
        $user_subscription->toarray();

        $all_subscriptions_names = [];

        foreach ($user_subscription as $each_subscription) {
            $returned_subscription = $each_subscription->subscription;//get object from user_subscription_table
            // (and run method which draw out subscription object from Subscription table)
            $final = $each_subscription->final_date;
            array_push($all_subscriptions_names, $returned_subscription->title_ru);
        }
        $this->data['user_subscription_list'][] = $all_subscriptions_names;
        $the_current_date = date('Y-m-d');


        $final_date = new DateTime($final);
        $datetime2 = new DateTime($the_current_date);
        $difference = $final_date->diff($datetime2);

        $this->data['days_untill_the_end'][] = $difference->days;

        return $this->data;
    }
}
