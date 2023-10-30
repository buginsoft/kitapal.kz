<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\UserSubscription;

class SubscriptionController extends Controller
{
    protected $data=[
        'card_colour'=>[],
        'button_colour'=>[],
        'post'=>[],
    ];
    public function index(){
        return view('admin.subscription.index',['list'=>Subscription::all()]);
    }

    public function update(Request $request,Subscription $subscription){

        if($request->has('price')) {
            $subscription->price = $request->price;
        }
        if($request->has('title_ru')) {
            $subscription->title_ru = $request->title_ru;
        }
        if($request->has('title_kz')) {
            $subscription->title_kz = $request->title_kz;
        }

        if($request->has('card_colour')) {
            $subscription->card_colour = $request->card_colour;
        }

        if($request->has('button_colour')) {
            $subscription->button_colour = $request->button_colour;
        }

        //Если ест фотки сохранить фотки
        if ($request->hasFile('post_image')) {
                $path = \App\Http\Helpers::newStoreImg($request->post_image,'image',$request);
                $subscription->post_image = $path;
        }


        if($request->has('information')) {
            $text = [];
            foreach (\App\Models\SubscriptionInformation::all() as $information) {

                if (array_key_exists($information->id, $request->information)) {
                    $result = 1;
                } else {
                    $result = 0;
                }
                $text[$information->id] = $result;

            }
            $subscription->description = json_encode($text, JSON_UNESCAPED_UNICODE);
        }

        $subscription->save();
        $this->data['card_colour'][]=$subscription->card_colour;
        $this->data['button_colour'][]=$subscription->button_colour;
        $this->data['post'][]=$subscription->post_image;
          

          return back();
    }
    public function edit($id){
        $title='';
        return view('admin.subscription.form' ,['subscription'=>Subscription::find($id),'title'=>$title]);
    }
    public function subscripted(Request $request){
        $list = UserSubscription::filter(request())->where('paid',1)->paginate(30);
        return view('admin.subscription.subscripted',compact('list'));
    }
    public function statistic()
    {

        $total_subscriptions = [];
        $paid_subs = [];
        $labels = [];
        $years = [];
        foreach (\App\Models\Subscription::orderBy('sort_num')->get() as $subscription) {
            array_push($total_subscriptions, \App\Models\UserSubscription::whereSubscriptionId($subscription->id)->wherePaid(1)->count());
            array_push($paid_subs, \App\Models\CustomerOrder::whereHas('user_subscription', function($q) use ($subscription){
                $q->where('subscription_id', $subscription->id)->wherePaid(1);})->sum('total'));
            array_push($labels, $subscription->title_kz);

        }

        $total_subscriptions = json_encode($total_subscriptions);
        $paid_subs = json_encode($paid_subs);
        $labels = json_encode($labels, JSON_UNESCAPED_UNICODE);
        $labels = str_replace('"', '\'', $labels);

        $colors = json_encode(['#4CFF33', '#33DDFF', '#B233FF', '#FF335B']);


        foreach (\App\Models\Subscription::all() as $subscription) {
            $data = [];
            for ($i = 1;  $i < 13;$i++) {
                array_push($data,\App\Models\UserSubscription::whereSubscriptionId($subscription->id)
                    ->whereMonth('created_at',$i)->whereYear('created_at',date('Y'))->wherePaid(1)->count());
            }
            array_push($years, (object)['name'=>$subscription->title_kz,'data'=>$data]);
        }
        $years = json_encode($years, JSON_UNESCAPED_UNICODE);

        return view('admin.subscription.statistic',compact('total_subscriptions','labels','colors','years','paid_subs'));
    }
}
