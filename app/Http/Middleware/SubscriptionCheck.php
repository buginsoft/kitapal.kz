<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Models\UserSubscription;

use Closure;

class SubscriptionCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user_subscription = UserSubscription::where('us_user_id', auth('api')->user()->user_id)->get();

         $status=false;
         $is_trial=false;

        foreach ($user_subscription as $key=>$value) {
            if ($value->us_active == 1) {
                return $next($request);
            }else if ($value->us_trial == 1 ){
//                $status= false;
                $is_trial= true;
            }
        }

        if (empty($user_subscription)){
            return response()->json(['status'=>$status, 'is_trial'=>$is_trial], 200);
        }

        return response()->json(['status'=>$status, 'is_trial'=>$is_trial], 200);
    }
}
