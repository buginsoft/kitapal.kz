<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function index()
    {
        return view('home');
    }

    public function share()
    {
        return view('share');
    }
    public function savemailandpass(Request $request){
        $user = \Auth::user();
        $user->email=$request->email;
        $user->password =$request->password;
        $user->save();
        return redirect('/profile');
    }
}
