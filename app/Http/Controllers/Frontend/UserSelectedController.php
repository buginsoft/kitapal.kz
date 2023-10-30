<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserSelected;
use App\Models\Book;

class UserSelectedController extends Controller
{

    public function store(Request $request)
    {

        if(!\Auth::check()){
            return 'false';
        }
        else{
            $user = \Auth::user();
            $book = new Book;
            return $book->addToSelected($user->user_id,$request->book_id);
        }
    }

}
