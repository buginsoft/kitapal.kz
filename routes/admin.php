<?php

use Illuminate\Support\Facades\Route;

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

