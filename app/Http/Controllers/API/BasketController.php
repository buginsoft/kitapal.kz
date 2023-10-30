<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Address;
use App\Models\UserBooks;
use App\Models\CustomerOrder;
use App\Models\OrderProducts;
use Pusher\Pusher;
use App\Models\City;
use Cart;
use Auth;
use App\Models\UserSubscription;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\UserBooksResource;;
use App\Classes\Promocode;

class BasketController extends Controller
{
    public $lang = 'ru';

    public function __construct(Request $request)
    {
        $this->lang = $request->header('lang')?:'ru';
    }
    public function getbasket(Request $request)
    {
        $user = auth()->guard('api')->user();
        $items = [];

        Cart::session($user->user_id)->getContent()->each(function($item) use (&$items)
        {
            $items[] = $item;
        });
        $total_quantity=0;
        $total_price=0;
        foreach($items as $item){
            $book=Book::find($item->attributes->book_id);
            if(!$book){
                return($item->attributes->book_id);
            }
            $item["id"]=$item->attributes->book_id;
            $item["book_image"]=$book->main_image()->path;
            $item["author"]=new AuthorResource($book->authors);
            $item['page_quanity']=$book->page_quanity;
            $item['isbn']=$book->isbn;
            $item['year']=$book->year;
            $total_quantity+=$item['quantity'];
            $total_price+=$item['quantity']*$item['price'];
        }
        return ['data'=>$items,'total_quantity'=>$total_quantity,'total_price'=>$total_price];
    }
    public function order(Request $request)
    {
        $user = auth()->guard('api')->user();
        $items = [];

        \Cart::session($user->user_id)->getContent()->each(function($item) use (&$items)
        {
            $items[] = $item;
        });
        foreach($items as $item){
            $book=Book::find($item->attributes->book_id);
            $item["book_image"]=$book->main_image()->path;
            $item["author"]=new AuthorResource($book->authors);
        }
        $personal_info["name"]=$user->user_name;
        $personal_info["email"]=$user->email;
        $personal_info["phone"]=$user->phone;
        $address = Address::where('user_id',$user->user_id)->first();
        $address_info=[];

        if($address) {
            $address_info['city'] = $address->city;
            $address_info['street'] = $address->street;
            $address_info['home'] = $address->home;
            $address_info['podezd'] = $address->podezd;
            $address_info['kvartira'] = $address->kvartira;
            $address_info['naselenny_punkt'] = $address->naselenny_punkt;
            $address_info['index'] = $address->post_index;
        }

        $cities = City::all();
        $post=\App\Models\DeliveryPrice::where('type','почта')->get();
        foreach($post as $item){
            $delivery_price['post'][$item->description] = $item->price;
        }
        $almatycourier=\App\Models\DeliveryPrice::where('type','Almaty')->get();

        $delivery_price['vkvadrate'] = $almatycourier[0]->price;
        $delivery_price['zakvadratom'] = $almatycourier[1]->price;
        $delivery_price['polygon3'] = $almatycourier[2]->price;
        $delivery_price['courierotheralmaty']= '1600';
        $delivery_price['free']= '15000';

        return ['data'=>
            [
                'pickup_address'=>'Мақатаев 128А (Сейфуллин қиылысы, нөлінші этаж). Жұмыс уақыты: дс-жұма 9:00-18:00; сенбі 9:00-14:00',
                'iscovid'=>1,
                'covidtext'=>'Карантинге байланысты курьерлік жеткізу тек Алматы қаласы бойынша жүргізіледі',
                'books'=>$items,
                'personal_info'=>$personal_info,
                'address_info'=>$address_info,
                'cities_list'=>$cities ,
                'deliver_price'=>$delivery_price
            ]
        ];
    }
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
        /* foreach ($request->book as $item){
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
    public function giftpage(Request $request){
        $book=Book::find($request->book_id);

        $result["book_id"]=$book->book_id;
        $result["book_image"]=url('/').$book->main_image()->path;
        $result["book_name"]=$book->book_name;
        $result["price"]=$book->ebook_price;
        $result["author"]=new AuthorResource($book->authors);

        return ['data'=>$result];
    }
    public function addtobasket(Request $request){
        $user = auth()->guard('api')->user();
        Cart::session($user->user_id);
        $items = Cart::getContent();

        if($request->type=='ebook'){
            if(substr($request->book_id, -1)=='e') {
                $book_id = substr($request->book_id, 0, -1);
            }
            else{
                $book_id =$request->book_id;
            }
        }
        elseif($request->type=='audio'){
            if(substr($request->book_id, -1)=='a') {
                $book_id = substr($request->book_id, 0, -1);
            }
            else{
                $book_id =$request->book_id;
            }
        }
        else{
            $book_id =$request->book_id;
        }

        //Удалить
        if($request->has('delete') && $request->delete==1){
            foreach ($items as $key => $item) {
                if ($item->attributes->book_id == $book_id && $item->attributes->type == $request->type) {

                    return ['success'=>Cart::remove($item->id)];
                }
            }
            return ['success'=>false];
        }

        else if($request->has('decrease') && $request->decrease==1){


            foreach ($items as $key => $item) {
                if ($item->attributes->book_id == $book_id && $item->attributes->type == $request->type) {
                    return ['success'=>Cart::update($item->id,['quantity' => -1])];
                }
            }
            return ['success'=>false];
        }
        else {
            $book  = new Book;
            $book->addBookToBasket($book_id,$request->type) ;
        }

        return ['success'=>true];
    }
    public function checkPromo(Request $request){
        $promo = new Promocode;
        return $promo->check($request->promocode);
    }
    public function createOrUpdateUserAddress(Request $request,$address){
        if(!$address){
            Address::create([
                'user_id'=>auth()->guard('api')->user()->user_id,
                'city' => $request->city,
                'street' => $request->street,
                'home' => $request->home,
                'naselenny_punkt'=>$request->naselenny_punkt,
                'podezd'=>$request->podezd,
                'kvartira'=>$request->kvartira,
            ]);
        }
        else{
            $address->update([
                'city' => $request->city,
                'street' => $request->street,
                'home' => $request->home,
                'naselenny_punkt'=>$request->naselenny_punkt,
                'podezd'=>$request->podezd,
                'kvartira'=>$request->kvartira,
            ]);
        }

    }

    public function updateUserData(Request $request){
        $request->validate([
            'phone' => 'required',
            'fio' => 'required'
        ]);
        $user = auth()->guard('api')->user();
        $user->user_name = $request->fio;
        $user->phone = $request->phone;
        $user->save();
    }
}
