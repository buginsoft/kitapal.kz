<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ForgetPassword;
use App\Http\Helpers;
use App\Models\User;
use Validator;

class PassportController extends Controller

{

    public $successStatus = 200;

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register','forgotPassword','socialAuth','setpassword']]);
    }

    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;

            return ['success'=>true, 'access_token' => $success['token']];
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    public function register(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'password_confirmation' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'string|required_with:password_confirmation|same:password_confirmation',
            'name' =>'required'
        ]);
        if ($validator->fails()) {
            $error = array();
            $error['success'] = ['status'=>false];
            $error['error'] = $validator->errors();

            return response()->json($error, 401);
        }
        $user= User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_name'=>$request->name
        ]);

        return ['success'=>['status'=>true, 'access_token'=>$user->createToken('MyApp')->accessToken]];
    }
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */

    public function getDetails()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }

    public function socialAuth(Request $request){
        $request->validate([
            'type' => ['required'],
        ]);

        if($request->type=='facebook'){
            return $this->findOrCreateUser($request->facebook_id,$request);
        }
        elseif($request->type =='google'){
            return $this->findOrCreateUser($request->google_id,$request);
        }
    }

    public function findOrCreateUser($id,$request){

        if($request->type=='google'){
            $user = User::where('google_id',$id)->first();
        }
        elseif($request->type=='facebook'){
            $user = User::where('facebook_id',$id)->first();
        }

        if(!$user) {
            $pass = new \App\Classes\Promocode;
            $user= User::create([
                'password' => Hash::make($pass->generate(15))
            ]);
            foreach ($request->input() as $key => $value) {
                if($key!='avatar' && $key!='type') {
                    $user[$key] = $value;
                }
            }
            if($request->has('avatar')){
                $user->avatar =  Helpers::storeFromUrl($request->avatar, 'avatar');
            }

            $user->save();
        }
        return [
            'success'=>true,
            'access_token' => $user->createToken('MyApp')->accessToken
        ];
    }
    public function forgotPassword(Request $request)
    {
        $user = User::where('email', 'like', '%'.$request->email.'%')->first();

        if (empty($user)){
            return response()->json(['success'=>false, 'message'=>'User does not exist'], $this->successStatus);
        }
        $hash = md5(uniqid(time(), true));
        $user->hash_email = $hash;
        $user->save();

        $objDemo = new \stdClass();
        $objDemo->email = $request->email;
        $objDemo->hash = $hash;
        $objDemo->sender = 'kitapal.kz';
        $objDemo->receiver = $user->user_name;

        Mail::to($objDemo->email)->send(new ForgetPassword($objDemo));

        $message = 'На Вашу почту отправлено письмо';
        return ['success' => true, 'message'=>$message];
    }
    
}