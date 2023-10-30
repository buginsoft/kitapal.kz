<?php

public function paymentInit(Request $request)
{
    if(!$request->has('update')){
        abort(404);
    }
    $user = auth()->guard('api')->user();
    $order = new CustomerOrder;
    $order->user_id = $user->user_id;
    $order->is_mobile = 1;
    $ebook=0;
    //$books=[];
    Cart::session($user->user_id);
    /*foreach ($request->book as $item){
        array_push($books,Cart::get($item)->attributes->book_id);
    }*/

    foreach (\Cart::session($user->user_id)->getContent() as  $item) {
        if($item['attributes']['type']=='paper'){
            if ($request->has('delivery_type')) {
                $this->updateUserData($request);
                if($request->delivery_type == 'post' || $request->delivery_type == 'courier') {
                    $this->createOrUpdateUserAddress($request,Address::where('user_id',$user->user_id)->first());
                }
                $order->deliveryprice = $request->delivery_price;
                $order->delivery_type = $request->delivery_type;
                $order->status_id = 1;
                $options = array(
                    'cluster' => env('PUSHER_APP_CLUSTER'),
                    'encrypted' => true
                );
                $pusher = new Pusher(
                    env('PUSHER_APP_KEY'),
                    env('PUSHER_APP_SECRET'),
                    env('PUSHER_APP_ID'),
                    $options
                );
                $data['message'] = 'Новый заказ';
                $pusher->trigger('notify-channel', 'App\\Events\\Notify', $data);
                break;
            }
            else{
                dd('error ');
            }
        }
        else {
            $ebook++;
        }
    }

    if(  $ebook ==\Cart::session($user->user_id)->getContent()->count()){

        //Если подарок
        if ($request->has('is_gift'))
        {
            $request->validate([
                'recipient_name' => 'required',
                'recipient_email' => 'required',
            ]);
            if($request->has('gift_comment')){
                $order->gift_comment =  $request->gift_comment;
            }
            $order->recipient_name = $request->recipient_name;
            $order->recipient_email = $request->recipient_email;
            $order->is_gift = $request->is_gift;
            $order->gift_token = \Illuminate\Support\Str::random(32);
        }
        //Электронная книга
        else {
            $this->updateUserData($request);
        }
        $order->is_seen = 1;

    }





    /**************************Почтамен заказ берсе сайкесинше доставка багасын озгерту****************************/
    if($request->has('delivery_type') && $request->delivery_type=='post'){
        $totalprice =\Cart::getTotal();
        \Cart::session($user->user_id);

        $order->deliveryprice=$order->getPostPrice($totalprice);
    }
    /**************************Почтамен заказ берсе сайкесинше доставка багасын озгерту****************************/

    $order->total = $request->price;
    $order->order_comment = $request->order_comment;
    $order->save();

    foreach (\Cart::session($user->user_id)->getContent() as  $item) {
        OrderProducts::create([
            'order_id' => $order->order_id,
            'product_id' => $item['attributes']['book_id'],
            'type' => $item['attributes']['type'],
            'quantity' => $item['quantity'],
            'unitprice' => $item['price']
        ]);
    }

    if($request->has('promocode')){
        $promocode = new \App\Classes\Promocode;
        $result = $promocode->check($request->promocode);

        if($result['success']=='true'){
            $order->promocode_id=$result['id'];
            $order->save();
        }
        else{
            return ['success'=>false];
        }
    }

    return ['fields'=>getPaymentLink($request->price+$order->deliveryprice ,  $order->order_id)];
}