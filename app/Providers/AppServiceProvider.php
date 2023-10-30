<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Contact;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $contacts = Contact::first();
        View::composer(['layouts.main','profile'], function($view) use ($contacts) {
            if(\Auth::user()){
                $cart=\Cart::session(\Auth::user()->user_id)->getContent();
            }
            else{
                $cart=0;
            }
            $view->with(['contacts' => $contacts,'cart'=>$cart]);
        });

        View::composer(['*'], function($view) {
            $view->with(['lang'=>\App::getLocale()]);
        });

    }
}
