<?php

namespace App\Http\Controllers\Frontend;

use App\Classes\Promocode;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Book;
use App\Models\City;
use App\Models\CustomerOrder;
use App\Models\DeliveryPrice;
use App\Models\OrderAddress;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BasketController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->middleware('auth')->except(
            'addToBasket',
            'index',
            'checkout',
            'nonregistredCheckout',
            'getPostPrice',
            'deliveryaddress',
            'saveDelPricenAddress',
            'checkpromo',
            'decreaseItemQuantity',
            'increaseItemQuantity',
            'deletefrombasket'
        );
        $this->user = Auth::user();
    }

    public function index()
    {
        $items = getCartContent();
        return view('basket', compact('items'));
    }

    //Добавить книгу в корзину
    public function addToBasket(Request $request)
    {
        if (!Auth::user() && $request->type == 'ebook') {
            return ['success' => false, 'message' => 'Не авторизованы'];
        }
        $book = new Book;
        $cart = $book->addBookToBasket($request->book_id, $request->type);

        return ['success' => true, 'cart' => $cart, 'currentitemquantity' => $cart->quantity];
    }

    public function checkout(Request $request)
    {
        $user = Auth::user();
        $items = getCartContent();

        //--------------------------------------Проверка цен книг-------------
        foreach ($items as $item) {

            $book = \App\Models\Book::find($item->attributes->book_id);

            if ($book->available == 0) {
                if ($item->attributes->type != 'ebook') {
                    $notify[] = ['error', 'Книги ' . $book->book_name . ' нет в наличий'];
                    return back()->withNotify($notify);
                }
            }
            if ($item->price != $book->getPrice($item->attributes->type)) {

                $notify[] = ['error', 'У книги ' . $book->book_name . ' цена отличается. Цена книги ' . $book->getPrice($item->attributes->type) . ' У вас в корзине оно по цене ' . $item->price . '  Удалите из корзины и добавьте сново'];
                return back()->withNotify($notify);
            }
        }
        //----------------------------------------------------

        $cities = City::all();
        $othercities = DeliveryPrice::where('type', 'Казахстан курьер')->first();
        $almatycourier = DeliveryPrice::where('type', 'Almaty')->get();
        $free = DeliveryPrice::where('type', 'free')->first();
        if ($user) {
            $address = Address::where('user_id', $user->user_id)->first();
        }
        if ($request->has('order_id')) {
            $order_id = $request->order_id;
            $order = \App\Models\CustomerOrder::find($order_id);
            if ($order->address_id) {
                $address = OrderAddress::find($order->address_id);
            }
        } else {
            if ($user) {
                $order = CustomerOrder::create(['user_id' => $user->user_id, 'total' => 0]);
            } else {
                $order = CustomerOrder::create(['total' => 0]);
            }
        }

        if ($user) {
            return view('checkout.checkout', compact('user', 'address', 'cities', 'items', 'othercities', 'almatycourier', 'free', 'order'));
        } else {
            return view('checkout.nonregistred_checkout', compact('cities', 'items', 'othercities', 'almatycourier', 'free', 'order'));
        }
    }

    public function deliveryaddress(Request $request)
    {
        $user = Auth::user();
        $payment = new  \App\Models\Payment;
        //$cities = City::all();
        $othercities = DeliveryPrice::where('type', 'Казахстан курьер')->first();
        $almatycourier = DeliveryPrice::where('type', 'Almaty')->get();
        $free = DeliveryPrice::where('type', 'free')->first();
        $order = \App\Models\CustomerOrder::find($request->order_id);
        $free_delivery = 1;
        if ($user) {
            $detailes = $payment->books_total_price2(\Cart::session(\Auth::user()->user_id)->getContent());
            $user->user_name = $request->fio;
            $user->phone = $request->phone;
            $user->save();
            $order->user_id = $user->user_id;
        } else {
            $detailes = $payment->books_total_price2(\Cart::session(session()->getId())->getContent());
            $order->user_name = $request->fio;
            $order->user_phone = $request->phone;
        }

        $books_total_price = $detailes['total_price'];

        //Если это бумажная книга
        if ($request->has('delivery_type')) {
            $order->delivery_type = $request->delivery_type;
            if ($request->delivery_type == 'post') {
                $order->deliveryprice = $order->getPostPrice($books_total_price);
            } else if ($request->delivery_type == 'pickup') {
                $order->deliveryprice = 0;
            }
        } else {
            //Если подарок
            if ($request->has('is_gift')) {
                $order->recipient_name = $request->recipient_name;
                $order->recipient_email = $request->recipient_email;
                $order->is_gift = $request->is_gift;
                if ($request->has('gift_comment')) {
                    $order->gift_comment = $request->gift_comment;
                }
                $order->gift_token = Str::random(32);
            } else {
                $user->user_name = $request->fio;
                $user->phone = $request->phone;
                $user->save();
            }
            $order->is_seen = 1;
        }

        $order->order_comment = $request->order_comment;
        $order->save();

        if ($order->address_id) {
            $address = OrderAddress::find($order->address_id);
        } else {
            $address = Address::where('user_id', $order->user_id)->first();
        }

        $cart = getCart();
        $items = getCartContent();
        $count = 0;

        foreach ($items as $item) {
            if ($item->attributes->type == 'paper') {
                $count++;
            }

            $book = \App\Models\Book::find($item->attributes->book_id);
            if ($book->free_delivery == 0) {
                $free_delivery = 0;
            }
        }
        if ($count > 0) {
            return view('checkout.checkout-delivery', compact('order', 'address', 'items', 'othercities', 'almatycourier', 'free', 'cart', 'free_delivery'));
        } else {
            dd("для электронной книги заполнять адрес необязательно ");
        }
    }

    //Китапты 1 ге кимиту
    public function decreaseItemQuantity(Request $request)
    {
        if (\Auth::user()) {
            Cart::session(Auth::user()->user_id);
        } else {
            Cart::session(session()->getId());
        }

        Cart::update($request->row_id, [
            'quantity' => -1,
        ]);
        return Cart::get($request->row_id);
    }

    //Китапты 1 ге осиру
    public function increaseItemQuantity(Request $request)
    {
        if (\Auth::user()) {
            Cart::session(Auth::user()->user_id);
        } else {
            Cart::session(session()->getId());
        }

        Cart::update($request->row_id, array('quantity' => 1));

        return Cart::get($request->row_id);
    }

    //Удалить с корзины
    public function deletefrombasket($row_id)
    {
        if (\Auth::user()) {
            Cart::session(Auth::user()->user_id);
        } else {
            Cart::session(session()->getId());
        }

        $bookquantity = Cart::get($row_id)->quantity;
        $totalcount = Cart::getTotalQuantity();
        $count = $totalcount - $bookquantity;
        $bookprice = Cart::get($row_id)->price * $bookquantity;
        $totalprice = Cart::getTotal();
        $price = $totalprice - $bookprice;

        Cart::remove($row_id);

        return ['shoppingcartcount' => $count, 'totalprice' => $price];
    }

    public function getPostPrice()
    {
        $post = DeliveryPrice::where('type', 'почта')->get();
        $prices = [];
        $cart = getCart();
        $price = $cart->getTotal();

        foreach ($post as $item) {
            $prices[$item->description] = $item->price;
        }
        foreach ($prices as $key => $value) {
            $array = explode('-', $key);

            if ($price >= intval($array[0]) && $price <= intval($array[1])) {
                return $value;
            }
        }
    }

    public function checkpromo(Request $request)
    {
        $promo = new Promocode;
        return $promo->check($request->promocode, $request->order_id);
    }

    public function saveDelPricenAddress(Request $request)
    {
        $validator = Validator::make($request->all(), ['city' => 'required', 'street' => 'required', 'home' => 'required']);
        if ($validator->fails()) {
            return ['status' => false, 'error' => $validator->errors()];
        }

        $order = \App\Models\CustomerOrder::find($request->order_id);
        if ($order->address_id) {
            $address = \App\Models\OrderAddress::find($order->address_id);
        } else {
            $address = new \App\Models\OrderAddress;
        }
        $address->city = $request->city;
        $address->street = $request->street;
        $address->home = $request->home;
        $address->podezd = $request->podezd;
        $address->kvartira = $request->kvartira;
        $address->naselenny_punkt = $request->naselenny_punkt;
        $address->post_index = $request->post_index;
        $address->save();

        if (!$order->address_id) {
            $order->address_id = $address->id;
        }

        $order->deliveryprice = $request->delivery_price;
        $order->save();

        return [
            'status' => true,
            'city' => \App\Models\City::find($address->city)->text_kz,
            'naselenny_punkt' => $address->naselenny_punkt,
            'streettitle' => $address->street,
            'hometitle' => $address->home,
            'podezd' => $address->podezd,
            'kvartira' => $address->kvartira,
            'post_index' => $address->post_index
        ];
    }
}
