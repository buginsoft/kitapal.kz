<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Support\Facades\Hash;
use Socialite;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout','changepass');
    }

    public function postLogin(Request $request)
    {
        request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...

            return redirect('/');
        }
        return Redirect::to("login")->withSuccess('Oppes! You have entered invalid credentials');
    }


    public function redirectToFacebookProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookProviderCallback()
    {
        $provider_user = Socialite::driver('facebook')->stateless()->user();
        $id = $provider_user->getId();
        $name = $provider_user->getName();

        $user = User::where('facebook_id', $id)->first();

        if (!$user) {

            $user = User::create([
                'user_name' => $name,
                'password' => Hash::make('123456789'),
                'facebook_id'=>$id
            ]);

            auth()->login($user);
            return redirect('/sociallogin');
        }
        else{
            auth()->login($user);
            return redirect()->intended($this->redirectPath());
        }
    }
    public function redirectToGoogleProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleProviderCallback()
    {
        $provider_user = Socialite::driver('google')->stateless()->user();
        $id = $provider_user->getId();

        $user = User::where('google_id', $id)->first();

        if (!$user) {
            $user = User::where('email', $provider_user->getEmail())->first();
            if (!$user) {
                $user = User::create([
                    'user_name' => $provider_user->getName(),
                    'email' => $provider_user->getEmail(),
                    'password' => Hash::make('123456789'),
                    'google_id' => $id
                ]);
                auth()->login($user);
                return redirect('/sociallogin');
            }
            $user->google_id=$id;
            $user->save();
        }
        auth()->login($user);
        return redirect()->intended($this->redirectPath());
    }

    public function changepass(Request  $request)
    {
        $user=Auth::user();

        if(!$request->has('current_password') || !$request->has('new_password') || !$request->has('confirm_password')){
            return back()->with('change_pass_error', 'заполните все поля');
        }
        if($request->new_password != $request->confirm_password){
            return back()->with('change_pass_error', 'Подтверждение пароля не совпадает');
        }

        if (Hash::check($request->current_password, $user->password)) {
            $user->password = \Hash::make($request->new_password);
            $user->save();
            return back()->with('change_pass_success', 'пароль изменен');
        }
        else{
            return back()->with('change_pass_error', 'текущий пароль неправильный');
        }
    }
}
