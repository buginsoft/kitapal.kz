<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\City;
use App\Models\CustomerOrder;
use App\Http\Resources\OrderResource;
use App\Http\Helpers;
use App\Models\UserSubscription;
use App\Http\Resources\SubscriptionArrayResource;

class ProfileController extends Controller
{
    private $user;
    public function __construct()
    {
        $this->user =  auth()->guard('api')->user();
    }
    public function getProfile(Request $request)
    {
        $total_quantity=0;
        $user = $this->user;

        \Cart::session($user->user_id)->getContent()->each(function($item) use (&$items)
        {
            $items[] = $item;
        });

        if(isset($items) && count($items)) {
            foreach ($items as $item) {
                $total_quantity += $item->toArray()['quantity'];
            }
        }
        $address = Address::where('user_id',$user->user_id)
            ->select("city", "street", "home", "podezd", "kvartira", "naselenny_punkt",'post_index')->first();
        $cities = City::all();
        $user_subscription = UserSubscription::where([['user_id',$user->user_id],['active',1]])->first();

        return [
            'user_id'=>$user->user_id,
            'user_name'=>$user->user_name,
            'email'=>$user->email,
            'phone'=>$user->phone,
            'address'=>$address,
            'cities'=>$cities,
            'avatar'=>url('/').$user->avatar,
            'subscription'=>$user_subscription?new SubscriptionArrayResource($user_subscription,$request->lang):null,
            'books_quantity'=>$total_quantity,
        ];
    }
    public function updateProfile(Request $request){
        if($request->filled('new_password')){
            if(\Hash::check($request->old_password,$this->user->password)){
                $this->user->password = \Hash::make($request->new_password);
            }
            else{
                return [
                    'success'=>false
                ];
            }
        }
        if($request->filled('phone')){
            $this->user->phone = $request->phone;
        }
        if($request->filled('name')){
            $this->user->user_name = $request->name;
        }
        if ($request->hasFile('avatar')){
            $this->user->avatar=Helpers::storeImg('avatar', 'image', $request);
        }
        $this->user->save();


        $address= Address::firstOrCreate(['user_id' => $this->user->user_id]);

        if($request->filled('city_id')){
            $address->city=$request->city_id;
        }
        if($request->filled('street')){
            $address->street=$request->street;
        }
        if($request->filled('home')){
            $address->home=$request->home;
        }
        if($request->filled('podezd')){
            $address->podezd=$request->podezd;
        }
        if($request->filled('kvartira')){
            $address->kvartira=$request->kvartira;
        }
        if($request->filled('naselenny_punkt')){
            $address->naselenny_punkt=$request->naselenny_punkt;
        }
        if($request->filled('index')){
            $address->post_index=$request->index;
        }
        $address->save();

        return [
            'success'=>true
        ];
    }
    public function shoppingHistory(Request $request){
        $orders = CustomerOrder::where([['paid',1], ['user_id',$this->user->user_id]])->get();
        return new OrderResource($orders,$request->lang);
    }
}
