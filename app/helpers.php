<?php

use Pusher\Pusher;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

if (! function_exists('send_push')) {
    function send_push($data)
    {
        $notification = new \App\Http\Controllers\API\NotificationController;
        $notification->sendWebNotification($data);
    }
}

if (! function_exists('pusher')) {
    function pusher($data)
    {
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
    }
}
//Может ли юзер читать эту книгу
function check_access($user,$book_id)
{
    if( $book = \App\Models\Book::find($book_id)){
        $path = explode("/", $book->ebook_path);
        $last = end($path);
    }
    else{
        return ['success' => false];
    }
    if($book->free){
        return ['success' => true, 'book' => $book, 'last' => $last];
    }
    if ($user) {
        if (\App\Models\UserBooks::where([['ub_user_id', $user->user_id], ['ub_book_id', $book_id], ['type','ebook']])->first() || ($book->subscribable && \App\Models\UserSubscription::where([['user_id', $user->user_id], ['active', 1]])->count())) {
            return ['success' => true, 'book' => $book, 'last' => $last];
        }
    }
    return ['success' => false];
}

//Может ли юзер читать эту книгу
function check_access_audio($user,$book_id)
{
    if( $book = \App\Models\Book::find($book_id)){
        $path = explode("/", $book->ebook_path);
        $last = end($path);
    }
    else{
        return ['success' => false];
    }
    if($book->free){
        return ['success' => true, 'book' => $book, 'last' => $last];
    }
    if ($user) {
        if (\App\Models\UserBooks::where([['ub_user_id', $user->user_id], ['ub_book_id', $book_id], ['type','audio']])->first() || ($book->subscribable && \App\Models\UserSubscription::where([['user_id', $user->user_id], ['active', 1]])->count())) {
            return ['success' => true, 'book' => $book, 'last' => $last];
        }
    }
    return ['success' => false];
}
function getCart(){
    $session_id = Auth::user()?Auth::user()->user_id:session()->getId();
    return \Cart::session($session_id);
}
function getCartContent(){
    return getCart()->getContent();
}

function getPaymentLink($amount ,$order_id){
    $payment = new \App\Classes\Robokassa;
    return $payment->getLink($amount , $order_id, true);
}

function newStoreImg($image, $disk_name, $request)
{
    $image_name = $image->getClientOriginalName();
    $extension = $image->getClientOriginalExtension();
    $destinationPath = $request->disk . '/' . date('Y') . '/' . date('m') . '/' . date('d');
    $image_name = $destinationPath . '/' . $image_name;

    if (\Illuminate\Support\Facades\Storage::disk($disk_name)->exists($image_name)) {
        $now = \DateTime::createFromFormat('U.u', microtime(true));
        $image_name = $destinationPath . '/' . $now->format("Hisu") . '.' . $extension;
    }

    \Illuminate\Support\Facades\Storage::disk($disk_name)->put($image_name, \Illuminate\Support\Facades\File::get($image));

    if ($disk_name == 'avatar') {
        $result = '/media_avatar' .$image_name;
    }else{
        $result = '/media' .$image_name;
    }
    return $result;
}
