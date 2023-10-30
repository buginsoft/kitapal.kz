<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;



class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $primaryKey = 'user_id';
    protected $guarded = ['id'];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function books()
    {
        return $this->belongsToMany('App\Models\Book', 'user_books', 'ub_user_id', 'ub_book_id')->withPivot('type');
    }

    public function user_books()
    {
        return $this->hasMany('App\Models\UserBooks','ub_user_id');
    }

    public function ebooks()
    {
        return $this->belongsToMany('App\Models\Book', 'user_books', 'ub_user_id', 'ub_book_id')->where('type', 'ebook')->withPivot('type');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function address()
    {
        return $this->hasOne('App\Models\Address', 'user_id');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\CustomerOrder', 'user_id')->where('paid', 1);
    }

    public function selected()
    {
        return $this->belongsToMany('App\Models\Book', 'user_selecteds', 'user_id', 'book_id');
    }

    public function subscription()
    {
        return $this->hasOne('App\Models\UserSubscription', 'user_id')->where('active', 1);
    }

    public function last_subscription()
    {
        return $this->hasOne('App\Models\UserSubscription', 'user_id')->orderBy('final_date','desc')->limit(1);
    }

    public function subscriptionReading()
    {
        return $this->belongsToMany('App\Models\Book', 'user_subscription_reading', 'user_id', 'book_id')->withPivot('type');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\MailResetPasswordNotification($token));
    }

    //Может ли юзер читать эту книгу
    public function check_access($book_id)
    {
        if( $book = Book::find($book_id)){
            $path = explode("/", $book->ebook_path);
            $last = end($path);
        }
        if($book->free){
            return ['success' => true, 'book' => $book, 'last' => $last];
        }
        if (\Auth::check() && $book = Book::find($book_id)) {
            if (\App\Models\UserBooks::where([['ub_user_id', $this->user_id], ['ub_book_id', $book_id], ['type','ebook']])->first() || ($book->subscribable && \App\Models\UserSubscription::where([['user_id', auth()->user()->user_id], ['active', 1]])->count())) {
                return ['success' => true, 'book' => $book, 'last' => $last];
            }
            /*if (\App\Models\UserBooks::where([['ub_user_id', $this->user_id], ['ub_book_id', $book_id], ['type','ebook']])->first() ) {
                return ['success' => true, 'book' => $book, 'last' => $last];
            }*/
        }
        return ['success' => false];
    }

    public function now_reading_book(){
        return $this->belongsToMany('App\Models\Book','now_reading_table','user_id','book_id');
    }
}
