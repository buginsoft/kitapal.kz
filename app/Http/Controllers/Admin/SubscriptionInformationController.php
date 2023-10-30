<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\SubscriptionInformation;

class SubscriptionInformationController extends Controller
{
    public function index(){
        return view('admin.subscription.information.index',['list'=>SubscriptionInformation::orderBy('sort')->get()]);
    }
    public function store(Request $request){
        SubscriptionInformation::create([
            'title_kz'=>$request->title_kz,
            'title_ru'=>$request->title_ru,
            'sort'=>$request->sort
        ]);
        return back();
    }
    public function edit($id){
        return view('admin.subscription.information.form',['item'=>  SubscriptionInformation::find($id)]);
    }
    public function update(Request $request,$id){
        SubscriptionInformation::where('id',$id)->update([
            'title_kz'=>$request->title_kz,
            'title_ru'=>$request->title_ru,
            'sort'=>$request->sort
        ]);
        return back();
    }
    public function destroy($id){
        SubscriptionInformation::where('id',$id)->delete();
        return back();
    }
}
