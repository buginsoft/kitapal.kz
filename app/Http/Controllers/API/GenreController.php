<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Models\Book;
use App\Models\BookGenre;
use App\Models\Genre;

class GenreController extends Controller
{
    public $lang = 'ru';


    public function getGenreList(Request $request)
    {
        $lang = $request->lang;
        $genre = Genre::select(
                            'genre_id',
                            'genre_name_'.$lang,'genre_image'
                        )->orderBy('sort_num', 'asc')->get();

        $row = array();
        foreach ($genre as $key=>$value){
            $row[$key]['genre_id'] = $value->genre_id;
            $row[$key]['genre_name'] = $value['genre_name_'.$lang];
            $row[$key]['genre_image'] = $value->genre_image;
        }

        $result['data'] = $row;
        $result['status'] = true;

        return $result;

    }
}
