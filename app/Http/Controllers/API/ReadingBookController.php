<?php

namespace App\Http\Controllers\API;

use App\Models\NowReadingBook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ReadingBookController extends Controller
{
    public function addReadingBook(Request $request){

        $reading = NowReadingBook::firstOrCreate([
            'user_id'=> auth()->guard('api')->user()->user_id,
            'book_id'=> $request->book_id,
            'reading'=> $request->reading,
            'finish'=> 0
        ]);
        if($reading) {
            if(request()->filled('subscription')){
                $reading->subscription = request()->subscription;
                $reading->save();
            }

            return ['success' => true];
        }
        else{
            return ['success' => false];
        }

    }
}
