<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showNewPassword(Request $request)
    {

        $user = User::where('email',$request->email)->where('hash_email',$request->hash)->first();
        if($user == null) {
            return  view('index.auth.login',
                [
                    'row'=> $request,
                    'error' => __('password.error_link')
                ]);
        }

        return  view('auth.passwords.customreset',
            [
                'email'=> $request->email,
                'hash'=>$request->hash
            ]
        );
    }
    public function setNewPassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'password' => 'required|min:5',
            'password_confirmation' => 'required|same:password|min:5',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();

            return  view('index.auth.password', [
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $user = User::where('email',$request->email)->where('hash_email',$request->hash_email)->first();

        if($user == null) {
            return  view('auth.login',
                [
                    'row'=> $request,
                    'error' => __('password.error_data')
                ]);
        }

        $user->password = \Hash::make($request->password);
        $user->save();

        $userdata = array(
            'email' => $request->email,
            'password' => $request->password
        );

        if (!\Auth::attempt($userdata))
        {
            $error = __('password.error_login_or_pass');
            return  view('auth.login', [
                'login' => $request->login,
                'error' => $error
            ]);
        }

        return redirect('/profile');
    }

}
