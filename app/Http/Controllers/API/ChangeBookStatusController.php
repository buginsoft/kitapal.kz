<?php

namespace App\Http\Controllers\API;

use App\Models\NowReadingBook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ChangeBookStatusController extends Controller
{


    public function changeStatus(Request $request)
    {
        $finded = NowReadingBook::where('book_id', $request->book_id)
                                    ->where('user_id',(auth()->guard('api')->user()->user_id))->where('finish',0)
                                    ->first();


        $finded->update(['finish' => 1]);

        return ['success' => true];


    }

}
