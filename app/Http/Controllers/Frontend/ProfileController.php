<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\CustomerOrder;
use App\Models\UserSelected;
use App\Models\City;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $address = Address::where('user_id',$user->user_id)->first();
        $cities = City::all();
        $orders = CustomerOrder::where('paid',1)->where('user_id',$user->user_id)->get();
        $selected = UserSelected::where('user_id',$user->user_id)->get();

        return view('profile',compact('user','address','cities','orders','selected'));
    }
    public function update(Request $request)
    {
        $user = Auth::user();

        if($request->has('city') || $request->has('street') || $request->has('home') || $request->has('podezd') || $request->has('kvartira') || $request->has('naselenny_punkt') ||$request->has('post_index')){
            $request->validate([
                'city' => 'required',
                'street' => 'required',
                'home' => 'required'
            ]);

            $address= Address::firstOrCreate(['user_id' => $user->user_id]);
            $address->city=$request->city;
            $address->street=$request->street;
            $address->home=$request->home;
            $address->podezd=$request->podezd;
            $address->kvartira=$request->kvartira;
            $address->naselenny_punkt=$request->naselenny_punkt;
            $address->post_index=$request->post_index;
            $address->save();
        }
        else{
            $request->validate([
                'name' => 'required'
            ]);
            if($request->has('phone') && !empty($request->phone)){
                $user->phone = $request->phone;
            }
            if($request->has('name') && !empty($request->name)){
                $user->user_name = $request->name;
            }
            $user->save();
        }

        return redirect()->back();
    }
    public function uploadavatar(Request $request){
        if ($_FILES["avatar"]["error"] == UPLOAD_ERR_OK)
        {
            $image = $request->file('avatar');
            $image_name = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $destinationPath = $request->disk . '/' . date('Y') . '/' . date('m') . '/' . date('d');
            $image_name = $destinationPath . '/' . $image_name;

            if (Storage::disk('image')->exists($image_name)) {
                $now = \DateTime::createFromFormat('U.u', microtime(true));
                $image_name = $destinationPath . '/' . $now->format("Hisu") . '.' . $extension;
            }

            Storage::disk('image')->put($image_name, File::get($image));
            $result = '/media' .$image_name;
            $user=\Auth::user();
            $user->avatar=$result;
            $user->save();
            return $result;
        }
    }

    public  function saveaddress(Request $request){
        $validator = Validator::make($request->all(), ['city' => 'required','street' => 'required','home' => 'required']);
        if ($validator->fails()) {
            return ['status' => false, 'error' => $validator->errors()];
        }

        $order = \App\Models\CustomerOrder::find($request->order_id);

        if($order->address_id){
            $address = \App\Models\OrderAddress::find($order->address_id);
        }
        else{
            $address = new \App\Models\OrderAddress;
        }
        $address->city = $request->city;
        $address->street = $request->street;
        $address->home = $request->home;
        $address->podezd = $request->podezd;
        $address->kvartira = $request->kvartira;
        $address->naselenny_punkt = $request->naselenny_punkt;
        $address->post_index = $request->post_index;
        $address->save();

        if(!$order->address_id){
            $order->address_id=$address->id;
            $order->save();
        }

        //$address->city = $address->citytitle['text_' . \App::getLocale()];
        if ($request->has('delivery_type')) {
            $order->delivery_type = $request->delivery_type;
            $order->save();
        }

       /* if ($order->delivery_type) {
            //window.location.replace('http://kitapal.kz/nonregistredcheckout?delivery_type=' + respond.delivery_type + '&order_id={{$order_id}}');
            return  redirect('\nonregistredcheckout',['order_id'=>$request->order_id,'delivery_type'=>$order->delivery_type]);
        }
        else {
            return  redirect('\nonregistredcheckout',['order_id'=>$request->order_id]);
            //window.location.replace('http://kitapal.kz/nonregistredcheckout?order_id={{$order_id}}');
        }*/

        return $address;
    }
}
