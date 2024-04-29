<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\CustomerOrder;
use App\Models\OrderProducts;
use App\Models\User;
use App\Models\UserBooks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class GiftController extends Controller
{
    public function index($book_id)
    {
        $order = CustomerOrder::create(['user_id' => Auth::user()->user_id, 'total' => 0]);
        $item = Book::find($book_id);
        return view('giftPage', compact('item', 'order'));
    }

    public function getgift(Request $request)
    {
        $order_id = $request->order_id;
        $token = $request->token;
        $order = CustomerOrder::find($order_id);
        $product = OrderProducts::where('order_id', $order_id)->first();
        if ($order) {
            if ($order->gift_token == $token) {

                $user = User::where('email', $order->recipient_email)->first();

                if ($user) {
                    UserBooks::create(['ub_user_id' => $user->user_id, 'ub_book_id' => $product->product_id, 'type' => 'ebook']);
                    $order->gift_token = '';
                    $order->save();

                    $request->session()->flash('success', __('gift.addedtoaccount'));
                    return redirect('/');
                } else {
                    $newuser = new User;
                    $newuser->email = $order->recipient_email;
                    $password = Str::random(8);
                    $newuser->password = Hash::make($password);
                    $newuser->save();
                    UserBooks::create(['ub_user_id' => $newuser->user_id, 'ub_book_id' => $product->product_id, 'type' => 'ebook']);

                    $to_name = $order->recipient_name;
                    $to_email = $order->recipient_email;
                    Mail::send('mails.newaccount', ['login' => $to_email, 'password' => $password], function ($message) use ($to_name, $to_email) {
                        $message->to($to_email, $to_name)
                            ->subject('Вы получили подарок');
                        $message->from('aydinkassymkhan@gmail.com', 'kitapall');
                    });
                    $order->gift_token = '';
                    $order->save();

                    $request->session()->flash('success', __('gift.addedandregdatasent'));
                    return redirect('/');
                }
            } else {
                $request->session()->flash('error', __('gift.invalidtoken'));
                return redirect('/');
            }
        } else {
            $request->session()->flash('error', __('gift.invalidorder'));
            return redirect('/');
        }
    }
}
