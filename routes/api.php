<?php

use Illuminate\Support\Facades\Route;

Route::namespace('API')->group(function () {

    Route::post('login', 'PassportController@login');
    Route::post('register', 'PassportController@register');
    Route::post('social-auth', 'PassportController@socialAuth');
    Route::post('forgot_password', 'PassportController@forgotPassword');

    Route::get('main', 'MainController@index');
    Route::get('page/{id}', 'MainController@getPage');
    Route::get('getBook', 'BookController@getBookById');
    Route::get('getCatalogBooks', 'BookController@getCatalogBooks');
    // Route::get('getAuthorBooks', 'BookController@getAuthorBooks');

    Route::get('myBooks', 'BookController@userBooks')->middleware('auth:api');
    Route::get('my-subscription', 'BookController@mySubscriptions')->middleware('auth:api');

    Route::post('leaveFeedback', 'BookController@leaveFeedback')->middleware('auth:api');

    Route::get('profile', 'ProfileController@getProfile')->middleware('auth:api');
    Route::post('updateProfile', 'ProfileController@updateProfile');
    Route::get('shoppingHistory', 'ProfileController@shoppingHistory')->middleware('auth:api');
    Route::get('search', 'BookController@search');

    Route::prefix('genre')->group(function () {
        Route::get('/', 'GenreController@getGenreList');
    });

    Route::middleware('auth:api')->group(function () {
        Route::get('basket', 'BasketController@getbasket');
        Route::get('order', 'BasketController@order');
        Route::get('giftpage', 'BasketController@giftpage');
        Route::post('addtobasket', 'BasketController@addtobasket');
        Route::get('paymentinit', 'BasketController@paymentInit');

        // Открыл книгу
        Route::get('opened-subscription-book', 'BookController@openedbook');
    });

    Route::get('/article', 'ArticleController@show');

    Route::prefix('book')->group(function () {
        Route::get('/', 'BookController@getBookList');
        Route::get('{id}', 'BookController@getBookById')->where('id', '[0-9]+');
        Route::get('{id}/audio', 'BookController@getBookAudioById')->middleware('sub_check');
        Route::get('{id}/audio/aibat', 'BookController@getFakeBookAudioById');
        Route::get('chapters', 'BookController@getBookChaptersById')->middleware('auth:api');
        Route::post('favorite_book', 'BookController@setFavoriteBook');
        Route::get('users_read', 'BookController@getUserReadBook');
        Route::post('read_remove', 'BookController@removeReadBook');
        Route::get('users_favorite', 'BookController@getUserFavoriteBook');
    });

    Route::prefix('slider')->group(function () {
        Route::get('/', 'SliderController@getSliderList');
    });

    Route::prefix('collection')->group(function () {
        Route::get('/', 'CollectionController@getCollectionList');
        Route::get('{id}', 'CollectionController@getCollectionByGenre');
    });

    Route::get('compilation/{id}', 'CollectionController@getCompilation');
    Route::prefix('text')->group(function () {
        Route::get('/', 'TextController@getTextList');
    });

    Route::prefix('problem')->group(function () {
        Route::post('/', 'ProblemController@setProblem')->middleware('auth:api');
    });
    Route::get('/change-status', 'ProblemController@setStatus')->middleware('web');
    Route::get('/get-status', 'ProblemController@getStatus')->middleware('web');
    Route::get('/navigation', 'MainController@navigation');
    Route::get('/test', 'MainController@test');
    Route::get('/getos', 'MainController@getOS');
    Route::get('/getos2', 'MainController@getOS2');

    // Проверка промокода
    Route::get('/checkPromo', 'BasketController@checkPromo');

    // Значения фильтров
    Route::get('/filter-values', 'BookController@filterValues');

    // Добавить в избранное
    Route::post('add-selected', 'BookController@addToSelected');

    Route::get('publisher', 'BookController@getPublisher');
    Route::get('author', 'BookController@getAuthor');
    Route::get('selected', 'BookController@getSelected')->middleware('auth:api');

    // Сохранить токен для пуш уведомления
    Route::post('/store-token', 'NotificationController@storeToken');

    Route::get('/subscriptions', 'SubscriptionController@getsubscriptions');
    Route::post('/subscription', 'SubscriptionController@buysubscription')->middleware('auth:api');;

    // TelegramBot api
    Route::get('/categories', 'TelegramBotApiController@getCategories');
    Route::get('/category/books', 'TelegramBotApiController@getCategoryBooks');
    Route::get('/book/search', 'TelegramBotApiController@search');

    // Открыл подписанную или купленную книгу
    Route::get('/user-reading-book', 'ReadingBookController@addReadingBook')->middleware('auth:api');

    // Завершил купленную книгу
    Route::get('/user-finished-book', 'ChangeBookStatusController@changeStatus')->middleware('auth:api');

    // Мои книги
    Route::get('/user-all-orders', 'UserOrdersController@start')->middleware('auth:api');

    // Мои подписки
    Route::get('/user-subscription', 'BookController@start')->middleware('auth:api');
    Route::get('/get-subscription', 'UserSubscriptionController@start')->middleware('auth:api');
//    Route::get('/subscriptions/{argument}', 'SubscriptionController@start');
});
