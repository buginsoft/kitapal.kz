<?php

namespace App\Http\Controllers\Admin\Subscription;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\UserSubscription;

class UserSubscriptionController extends Controller
{


    //изменить подписку вручную
    public function change(Request $request , UserSubscription $user_subscription){
        //$user_subscription= UserSubscription::find($request->user_subscription_id);
        $subscription=Subscription::find($request->subscription_id);

        UserSubscription::create([
            'user_id'=>$user_subscription->user_id,
            'subscription_id'=>$request->subscription_id,
            'active'=>1,
            'final_date'=>$user_subscription->created_at->addMonths($subscription->months),
            'paid'=>1,
            'manually'=>1,
            'comment'=>'Вручную продлен',
            'created_at'=>$user_subscription->created_at,
            'updated_at'=>$user_subscription->updated_at

        ]);

        $user_subscription->comment ='Вручную изменен срок подписки';
        $user_subscription->active=0;
        $user_subscription->save();

        return back();
    }
    public function destroy(Request $request,UserSubscription $user_subscription){
        $user_subscription->comment ='Вручную удален';
        $user_subscription->active=0;
        $user_subscription->save();

        return back();
    }
}
