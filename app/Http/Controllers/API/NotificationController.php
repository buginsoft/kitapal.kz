<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  App\Models\UserDeviceKeys;

class NotificationController extends Controller
{
    public function storeToken(Request $request)
    {
        if($request->has('user_id')){
            $userdk= UserDeviceKeys::where([['user_id',$request->user_id],['token',$request->token]])->count();
        }
        else{
            $userdk= UserDeviceKeys::where('token',$request->token)->count();
        }

        if ( $userdk==0) {
            if($request->has('user_id')){
                UserDeviceKeys::create(['user_id'=>$request->user_id,'token'=>$request->token]);
            }
            else{
                UserDeviceKeys::create(['token'=>$request->token]);
            }
            return ['Token successfully stored.'];
        }
        return ['Already has token.'];
    }

    public function sendWebNotification($response)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $FcmToken = UserDeviceKeys::pluck('token')->all();

        $serverKey = 'AAAAM-WKgaE:APA91bGXygPBURI2MqJ1BGhtHVSwljDblfDFhq8lDewE2_r5GhHz6kFhr434oQO4wnUOdJUVYdW_PBVOFg5wuWydlQAuf4PgIlkK9zYgiyIpcVLybuLMr9Ljy72cJTv9-vw4h894hUoV';

        $data = [
            "registration_ids" => $FcmToken,
            "notification" => [
                "title" => $response['title']
            ],
            "data"=>[
                "id" =>$response['id'],
                "text"=>$response['text'],
                "title"=>$response['title'],
                "type"=>$response['type']
            ]
        ];

        if($response['type']=='book'){
            $data['data']['book_image']=$response['image'];
        }
        $encodedData = json_encode($data);

        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);

        // Execute post
        $result = curl_exec($ch);


        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);
    }
}
