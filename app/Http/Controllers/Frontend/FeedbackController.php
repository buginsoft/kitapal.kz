<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Redirect;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function leave(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'book_id' => 'required',
            'text' => 'required|min:1',
            'rating' => 'required',
        ]);

        Feedback::create($validatedData);
        return Redirect::back();
    }
}
