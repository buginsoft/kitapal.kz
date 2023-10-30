<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $primaryKey = 'genre_id';
    protected $guarded = ['id'];

    public function books()
    {
        return $this->belongsToMany('App\Models\Book', 'book_genres', 'bg_genre_id', 'bg_book_id')->where('in_archive',0)->orderBy('is_first_book','desc');
    }
    //только бумажные книги тут ошибка
    public function paperbooks()
    {

        return $this->books()->whereNull('ebook_path')->whereNull('audio_file');
     //   return $this->belongsToMany('App\Models\Book', 'book_genres', 'bg_genre_id', 'bg_book_id')->whereNull('ebook_path')->whereNull('audio_file');
    }

    public function setimchitayut()
    {
        return $this->belongsToMany('App\Models\Book', 'book_genres', 'bg_genre_id', 'bg_book_id')->with('authors')->where('in_archive',0);
    }

    //telegramapi
    //только бумажные книги
    public function paperbooks2()
    {
        return $this->books()->where('paperbook_price','>',0);
    }
}
