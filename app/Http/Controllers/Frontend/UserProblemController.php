<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Problem;
use App\Models\City;
use Illuminate\Support\Facades\Validator;

class UserProblemController extends Controller
{
    public function savemessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' =>'required|string',
            'email' => 'email|required',
            'phone' => 'required|string',
            'problem_text'=>'required'
        ]);

        if ($validator->fails()) {
            return ['success'=>false,'errors'=>$validator->errors()->first()];
        }

        Problem::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'problem_text'=>$request->problem_text
        ]);

        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $remoteip = $_SERVER['REMOTE_ADDR'];
        $data = [
            'secret' => config('services.recaptcha.secret'),
            'response' => $request->get('recaptcha'),
            'remoteip' => $remoteip
        ];
        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            ]
        ];
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $resultJson = json_decode($result);

        if ($resultJson->success != true) {
            return ['success'=>false,'errors'=>'ReCaptcha Error'];
        }
        if ($resultJson->score >= 0.3) {
            return ['success'=>true,'message'=>'Успешно'];
        } else {
            return ['success'=>false,'errors'=>'ReCaptcha Error'];
        }
    }
}
