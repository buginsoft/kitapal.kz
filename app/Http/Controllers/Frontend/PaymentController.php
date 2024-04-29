<?php

namespace App\Http\Controllers\Frontend;

use App\Classes\Promocode;
use App\Classes\Robokassa;
use App\Http\Controllers\Controller;
use App\Http\Helpers;
use App\Models\CustomerOrder;
use App\Models\OrderProducts;
use App\Models\Promocodes;
use App\Models\Subscription;
use App\Models\UserBooks;
use App\Models\UserSubscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Pusher\Pusher;

class PaymentController extends Controller
{
    public function paymentInit(Request $request)
    {
        /*if(request()->ip()!='62.32.84.178'){
            dd('идет техническая работа');
        }*/
        $user = Auth::user();
        $order = CustomerOrder::find($request->order_id);
        $cart = $this->getCart();

        // Курьер мен почтада буган келгенге дейн ценасын и типын сактап кояды . КУрьер мен почта болса delivery_type келмиды
        if ($request->has('delivery_type')) {
            if ($request->delivery_type == 'pickup') {
                $order->deliveryprice = 0;
                $order->delivery_type = $request->delivery_type;
            } else {
                dd('Только самовывоз должен быть');
            }
        }
        $order->save();

        if ($order->delivery_type) {
            if ($order->delivery_type == 'post') {
                $order->deliveryprice = $order->getPostPrice($cart->getTotal());
            }
            if ($order->delivery_type == 'courier' && is_null($order->deliveryprice)) {
                dd('Цена доставки не может быть равно нулю');
            }
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
        } else {
            //Если подарок
            if ($request->has('is_gift')) {
                $order->recipient_name = $request->recipient_name;
                $order->recipient_email = $request->recipient_email;
                $order->is_gift = $request->is_gift;
                $order->gift_comment = $request->gift_comment;
                $order->gift_token = Str::random(32);
            } else {
                if ($request->fio != $user->user_name) {
                    $user->user_name = $request->fio;
                }
                if ($request->phone != $user->phone) {
                    $user->phone = $request->phone;
                }

                $user->save();
            }
            $order->is_seen = 1;
        }

        $order->total = $request->price;
        $payment_amount = $request->price + $order->deliveryprice;

        /*---------------------------------------Проверка промокода----------------------------------------------------*/
        if ($order->promocode_id) {
            $promocode = new Promocode;
            $promocodeer = Promocodes::find($order->promocode_id);
            $result = $promocode->check($promocodeer->code);

            if ($result['success'] == 'true') {
                $order->price_with_promocode = $cart->getTotal() * (100 - $result['percentage']) / 100;
                $payment_amount = ($cart->getTotal() * (100 - $result['percentage']) / 100) + $order->deliveryprice;
            } else {
                dd($result['error']);
            }
        }
        /*-------------------------------------------------------------------------------------------------------------*/
        $order->save();

        // Если покупает без регистраций .
        if (is_null($user) && $order->delivery_type == 'pickup') {
            $order->user_name = $request->fio;
            $order->user_phone = $request->phone;
            $order->save();
        }
        $this->creteOrderProducts($request, $cart);
        $payment = new Robokassa;

        return redirect($payment->getLink($payment_amount, $order->order_id));
    }

    public function creteOrderProducts(Request $request, $cart)
    {
        if (!request()->filled('is_gift')) {
            foreach ($cart->getContent() as $item) {
                OrderProducts::create([
                    'order_id' => $request->order_id,
                    'product_id' => $item['attributes']['book_id'],
                    'type' => $item['attributes']['type'],
                    'quantity' => $item['quantity'],
                    'unitprice' => $item['price']
                ]);
            }
        } else {
            OrderProducts::create([
                'order_id' => $request->order_id,
                'product_id' => $request->book[0],
                'type' => $request->booktypes[0],
                'quantity' => $request->bookquantity[0],
                'unitprice' => $request->price
            ]);
        }
    }

    public function getCart()
    {
        $session_id = Auth::user() ? Auth::user()->user_id : session()->getId();

        return \Cart::session($session_id);
    }

    public function robokassasuccess(Request $request)
    {
        Log::channel('wallet')->info(json_encode($request->all($request)));

        //
        \Log::channel('payments')->info($request->all());
        $payment = new Robokassa;
        $result = $payment->checkpayment();
        \Log::channel('payments')->info($result);

        if ($result['status']) {
            $order = CustomerOrder::find($result['inv_id']);

            if ($order->paid == 0) {
                if (!is_null($order->subscription_id)) {
                    $order->update(['paid' => '1', 'status_id' => '1', 'is_delivered' => 1]);
                    UserSubscription::find($order->subscription_id)->update(['active' => 1, 'paid' => 1]);
                } else {
                    $order->update(['paid' => '1', 'status_id' => '1']);

                    //----------------------Если использовал промокод то удалить промокод-------------------------------/
                    $promo = new Promocode;
                    $promo->used($order->user_id, $order->promocode_id);
                    //--------------------------------------------------------------------------------------------------/

                    if ($order->is_gift) {
                        //Отправляем ссылка на почту получаетеля
                        $to_name = $order->recipient_name;
                        $to_email = $order->recipient_email;
                        $comment = $order->gift_comment;
                        $mail_subject = app()->getLocale() == 'ru' ? 'Получите книгу' : 'Сізге кітап сыйлады';

                        Helpers::sendMail($mail_subject, $to_name, $to_email, 'mails.gift', $order->order_id, ['token' => $order->gift_token, 'order_id' => $request->WMI_PAYMENT_NO, 'comment' => $comment]);
                    } else {
                        foreach ($order->books as $book) {
                            UserBooks::create(['ub_user_id' => $order->user_id, 'ub_book_id' => $book->book_id, 'type' => $book->pivot->type]);
                        }
                    }
                    //-----------------------------------Увеличить количество купленного--------------------------------
                    foreach ($order->books as $book) {
                        if ($book->pivot->type == 'paper') {
                            $book->increment('bought_count');
                        } elseif ($book->pivot->type == 'ebook') {
                            $book->increment('ebook_bought_count');
                        } elseif ($book->pivot->type == 'audio') {
                            $book->increment('audio_bought_count');
                        }
                    }
                    //--------------START--Уведомление жиберу о том что успешно прошла покупка ************************/
                    $to_name = $order->user->user_name;
                    $to_email = $order->user->email;
                    $order_items = [];
                    foreach ($order->products as $product) {
                        array_push($order_items, [$product->book->book_name, $product->quantity, $product->type, $product->unitprice]);
                    }
                    $total = $order->total + $order->delivery_price;
                    if (app()->getLocale() == 'ru') {
                        Helpers::sendMail('Подтверждение об оплате', $to_name, $to_email, 'mails.successpurchased', $order->order_id, ['name' => $to_name, 'order_id' => $order->order_id, 'order_items' => $order_items, 'total' => $total]);
                    } else {
                        Helpers::sendMail('Төлем сәтті өтті', $to_name, $to_email, 'mails.successpurchased', $order->order_id, ['name' => $to_name, 'order_id' => $order->order_id, 'order_items' => $order_items, 'total' => $total]);
                    }
                    //-------------END--Уведомление жиберу о том что успешно прошла покупка ----------------------------/

                    //----------------Очистить корзину
                    \Cart::session($order->user_id)->clear();
                    //------------
                }
            }
        }
    }

    public function saveDeliveryPrice(Request $request)
    {
        $order = CustomerOrder::find($request->order_id);
        $delivery_price = \App\Models\DeliveryPrice::where('description', $request->area)->first();

        if ($order) {
            if ($delivery_price) {
                if ($order->update(['deliveryprice' => $delivery_price->price])) {
                    return 'true';
                } else {
                    return 'false';
                }
            } else {
                $order->update(['deliveryprice' => null]);
            }
        } else {
            return 'false';
        }
    }

    public function buysubscription(Request $request)
    {
        if ($request->has('manually') && $request->manually == '1' && \Auth::user()->user_role_id) {
            $subscription = Subscription::find($request->subscription_id);
            UserSubscription::create([
                'user_id' => $request->to_user,
                'subscription_id' => $request->subscription_id,
                'final_date' => Carbon::now()->addMonths($subscription->months),
                'paid' => 1,
                'active' => 1
            ]);

            return back();
        } else {
            $user = Auth::user();

            $user_subscription = UserSubscription::where('user_id', '=', $user->user_id)->get();

            if (isset($user_subscription)) {
                foreach ($user_subscription as $sub) {
                    $sub->update([
                        'paid' => 0,
                        'active' => 0,
                        'recurring' => 0,
                        'debiting_date' => null
                    ]);
                }
            }

            $subscription = Subscription::find($request->subscription_id);
            $user_sub = UserSubscription::create([
                'user_id' => $user->user_id,
                'subscription_id' => $request->subscription_id,
                'final_date' => Carbon::now()->addMonths($subscription->months),
                'paid' => 1,
                'active' => 1
            ]);

            $order = CustomerOrder::create([
                'user_id' => $user->user_id,
                'is_delivered' => 0,
                'total' => $subscription->price,
                'subscription_id' => $user_sub->id,
            ]);

            $recurring = false;
            if ($request->recurring != null) {
                $recurring = true;
                $user_sub->update([
                    'recurring' => $request->recurring,
                    'debiting_date' => Carbon::now()->addMonths($subscription->months)
                ]);
            }

            $payment = new Robokassa;

            return redirect($payment->getLink($subscription->price, $order->order_id, $recurring));
        }
    }

    public function successpage()
    {
        return redirect('https://kitapal.kz/?paymentstatus=1');
    }

    public function errorpage()
    {
        return redirect('https://kitapal.kz/?paymentstatus=0');
    }

    public function unsubscribe($user_id)
    {
        $user_subscription = UserSubscription::where('user_id', '=', $user_id)->get();

        foreach ($user_subscription as $sub) {
            $sub->update([
                'paid' => 0,
                'active' => 0,
                'recurring' => 0,
                'debiting_date' => null
            ]);
        }

        return Redirect::to('/profile');
    }
}
