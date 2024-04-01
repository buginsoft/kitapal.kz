<?php

use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('loginasuser/{user_id}', function ($user_id) {
    Auth::loginUsingId($user_id);
});

Route::get('locale/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
});

Route::middleware(['auth', 'admin'])->namespace('Admin')->prefix('admin')->group(function () {
    Route::get('dashboard', 'StatisticController@dashboard');
    Route::resource('users', 'UsersController');


    //-----------------subscription------------------------------------------------
    Route::resource('subscription', 'SubscriptionController');
    Route::get('subscripted', 'SubscriptionController@subscripted');
    Route::resource('subscription-information', 'SubscriptionInformationController');
    Route::get('subscription-statistic', 'SubscriptionController@statistic');
    Route::resource('subscription-faq', 'SubscriptionFaqController');
    Route::put('user_subscription/{user_subscription}', 'Subscription\UserSubscriptionController@change');
    Route::delete('user_subscription/{user_subscription}', 'Subscription\UserSubscriptionController@destroy');
    //---------------------------------------------------------------------------------

    Route::get('userEbooks', 'UsersController@getUserEbooks');
    Route::post('add', 'UsersController@addEbookToUser');

    Route::resource('genre', 'GenresController');
    Route::resource('author', 'AuthorController');
    Route::resource('publisher', 'PublisherController');
    Route::resource('translator', 'TranslatorController');
    Route::resource('book', 'BookController');
    Route::get('export/{type}', 'ExportController');
    Route::post('/change-percentage/{book_id}', 'BookController@changPercentage');

    Route::post('archive-status', 'BookController@archive');
    Route::resource('collection', 'CollectionController');
    Route::resource('pages', 'PageController');
    Route::resource('chapter', 'ChaptersController');
    Route::resource('text', 'TextController');
    Route::resource('slider', 'SliderController');
    Route::resource('article', 'ArticleController');
    Route::resource('menu', 'MenuController');
    Route::resource('promocodes', 'PromocodesController');
    Route::post('generate-promocode', 'PromocodesController@generate');
    Route::resource('user_problem', 'UserProblemController');
    Route::get('index', function () {
        return redirect('admin/dashboard');
    });
    Route::resource('contacts', 'ContactController');
    Route::resource('orders', 'OrderController');
    Route::get('notpaidorders', 'OrderController@notpaid');
    Route::post('changeStatus', 'OrderController@changestatus');
    Route::resource('delivery_price', 'DeliveryPriceController');
    Route::get('/acceptOrder/{order_id}', 'OrderController@acceptOrder');
    Route::get('/delivered/{order_id}', 'OrderController@delivered');

    Route::get('/book-sales', 'StatisticController@booksSales');
});

Route::middleware(['web'])->group(function () {
    Route::get('media/{file_name}', 'MediaController@getImage')->where('file_name', '.*');
    Route::get('thumbnail/{file_name}', 'MediaController@getThumbnail')->where('file_name', '.*');
    Route::get('media_avatar/{file_name}', 'MediaController@getAvatar')->where('file_name', '.*');
    Route::get('media_doc/{file_name}', 'MediaController@getFile')->where('file_name', '.*');
    Route::get('admin/login', 'Admin\LoginController@index');
    Route::post('admin/login', 'Admin\LoginController@authenticate');
    Route::get('admin/authorbooks/{author_id}', 'Admin\AuthorController@authorbooks');
});

Route::namespace('Frontend')->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::post('/uploadavatar', 'ProfileController@uploadavatar');
        Route::get('/profile', 'ProfileController@index');

        Route::get('buy-subscription', function (\Illuminate\Http\Request $request) {
            $books = \App\Models\Book::take(50)->paginate(15);
            return view('subscription.index', compact('books'));
        });

        Route::post('buy-subscription', 'PaymentController@buysubscription');

    });
    Route::get('/basket', 'BasketController@index');
    Route::post('/selected', 'UserSelectedController@store');
    Route::get('/', 'IndexController@index');
    Route::get('/catalog/{catalog_id}', 'CatalogController@index');

    Route::get('/collection/{id}', 'CollectionController');

    Route::get('/book/{book_url}', 'BookController@index');

    Route::post('/addToBasket', 'BasketController@addToBasket');
    Route::post('/deletefrombasket/{row_id}', 'BasketController@deletefrombasket');
    Route::post('/decreaseItemQuantity', 'BasketController@decreaseItemQuantity');
    Route::post('/increaseItemQuantity', 'BasketController@increaseItemQuantity');

    Route::get('/checkout', 'BasketController@checkout');
    Route::post('/checkout-delivery', 'BasketController@deliveryaddress');
    Route::post('/updateProfile', 'ProfileController@update');
    Route::get('/search', 'BookController@search');
    Route::get('/articles', 'ArticleController@index');
    Route::get('/article/{article_id}', 'ArticleController@show');
    Route::get('/page/{page_id}', 'PageController@index');
    Route::post('/leavefeedback', 'FeedbackController@leave');

    //payment
    Route::post('/paymentInit', 'PaymentController@paymentInit');
    Route::any('/robokassasuccess', 'PaymentController@robokassasuccess');
    Route::get('/succespayment', 'PaymentController@successpage');
    Route::get('/errorpayment', 'PaymentController@errorpage');


    Route::get('/giftpage/{book_id}', 'GiftController@index');
    Route::get('/getgift', 'GiftController@getgift');
    Route::post('/sendMessage', 'UserProblemController@savemessage');
    //цена почтовой отправки
    Route::get('/getPostPrice', 'BasketController@getPostPrice');
    //Показать вью изменить пароль
    Route::get('auth/password', 'AuthController@showNewPassword');
    Route::post('auth/setNewPassword', 'AuthController@setNewPassword');
    Route::post('saveAddress', 'ProfileController@saveaddress');
    Route::post('saveDelPricenAddress', 'BasketController@saveDelPricenAddress');
    Route::post('checkpromo', 'BasketController@checkpromo');

    Route::get('author/{author_id}', 'IndexController@getAuthor');
    Route::get('publisher/{publisher_id}', 'IndexController@getPublisher');
});

//Route::get('/readbook/{book_id}', 'Frontend\BookController@readbook');

Route::get('/readfragment/{book_id}', function ($book_id) {
    $book = Book::find($book_id);
    $type = 'fragment';
    $path = explode("/", $book->ebook_path);
    $last = end($path);

    return view('readbook', compact('book', 'type', 'last'));
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


Route::get('share', 'HomeController@share');

Route::middleware(['web'])->namespace('Auth')->group(function () {
    Route::get('/logout', 'LoginController@logout');
});

Route::get('makethumb', function () {
    $books = \App\Models\Book::whereNull('book_image_thumb')->get();

    foreach ($books as $book) {
        $path = storage_path() . '/app/image/' . substr($book->book_image, 7);
        $resize = Image::make($path)->fit(150, 250)->encode('jpg');
        $hash = md5($resize->__toString());
        $path = "{$hash}.jpg";
        $resize->save(storage_path('app/image/' . $path));
        $result = '/media/' . $path;
        $book->book_image_thumb = $result;
        $book->save();
    }
});

/*Login with social*/
Route::get('login/facebook', 'Auth\LoginController@redirectToFacebookProvider')->name('login.facebook');
Route::get('login/facebook/callback', 'Auth\LoginController@handleFacebookProviderCallback');
Route::get('login/google', 'Auth\LoginController@redirectToGoogleProvider')->name('login.google');
Route::get('login/google/callback', 'Auth\LoginController@handleGoogleProviderCallback');
Route::post('changepass', 'Auth\LoginController@changepass');


Route::get('sociallogin', function () {
    return view('auth.sociallogin');
});

Route::post('savemailandpass', 'HomeController@savemailandpass');
Route::post('save-delivery-price', 'Frontend\PaymentController@saveDeliveryPrice');
//не удалять
Route::get('/favicon', function () {
    return 'https://kitapal.kz/storage/files/1/ebooks/';
});

Route::get('/thumb', function () {
    $images = \App\Models\BookImages::all();
    foreach ($images as $item) {

        $path = storage_path() . '/app/image/' . substr($item->path, 7);
        $resize = Image::make($path)->fit(180, 250)->encode('png');
        $hash = md5($resize->__toString());
        $path = "{$hash}.png";
        $resize->save(storage_path('app/thumbnail/' . $path));
        $result = '/thumbnail/' . $path;
        $item->thumbnail180_250 = $result;
        $item->save();

    }
});


Route::post('discount-to-all-books', function (\Illuminate\Http\Request $request) {
    if ($request->percentage == 0) {
        foreach (\App\Models\Book::all() as $item) {
            $item->sale_percentage = Null;
            $item->save();
        }
    } else {
        foreach (\App\Models\Book::all() as $item) {
            $item->sale_percentage = $request->percentage;
            $item->save();

        }
    }
    return back();
});


Route::get('testredis', 'IndexController@testredis');


Route::post('import', function () {
    \Excel::import(new \App\Imports\BookImport, request()->file('books'));
    return back();
});


Route::get('testemail', function () {

    //\App\Http\Helpers::sendMail('Заказ принят',$to_name,$to_email,'mails.orderaccepted', $order->order_id,[ 'name'=>$to_name ,'order_id' => $order->order_id ]);
    //  Helpers::sendMail('Получите книгу',$to_name,$to_email,'mails.gift', $order->order_id,['token' => $order->gift_token, 'order_id' =>$request->WMI_PAYMENT_NO ,'comment'=>$comment]);

    $order = \App\Models\CustomerOrder::find(57092);
    $order_items = [];
    foreach ($order->products as $product) {
        array_push($order_items, [$product->book->book_name, $product->quantity, $product->type, $product->unitprice]);
    }

    $to_name = 'ап';
    $to_email = 'qlinemlm@gmail.com';
    //$subject = 'Заказ принят';
    //$subject = 'Заказ доставлен';
    $subject = 'Төлем сәтті өтті';


    $parameters = ['name' => $to_name, 'order_id' => $order->order_id, 'order_items' => $order_items, 'total' => 5000];
    \Mail::send('mails.successpurchased', $parameters,
        function ($message) use ($to_name, $to_email, $subject) {
            $message->to($to_email, $to_name)
                ->subject($subject);
            $message->from('kitapall18@gmail.com', 'kitapall');
        });
});

Route::get('allaudio', function () {

    //Отправляем ссылка на почту получаетеля
    $to_name = 'Нурасыл Тенизбаев';
    $to_email = 'yermek.tenizbayev@bk.ru';
    $comment = 'Mmm';
    $mail_subject = app()->getLocale() == 'ru' ? 'Получите книгу' : 'Сізге кітап сыйлады';

    \App\Http\Helpers::sendMail($mail_subject, $to_name, $to_email, 'mails.gift', 60380, ['token' => 'M4w7QUPjDIQZDTNY8NDNEoAx7RcFzj7D', 'order_id' => 60380, 'comment' => $comment]);
});

//ckeditor
Route::post('ckeditor/upload', 'CkeditorController@upload')->name('ckeditor.upload');
