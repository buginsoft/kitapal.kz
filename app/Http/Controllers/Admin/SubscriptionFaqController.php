<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\SubscriptionInformation;

class SubscriptionFaqController extends Controller
{
    public function index(){
        return view('admin.subscription.faq.index',['list'=>\App\Models\SubscriptionFaq::orderBy('order')->get()]);
    }
    public function create(){
        return view('admin.subscription.faq.form',['action'=>'/admin/subscription-faq']);
    }
    public function store(Request $request){

        $faq = \App\Models\SubscriptionFaq::create([
            'name'=>$request->name,
            'order'=>$request->order
        ]);
        \App\Models\Content::create([
            'contentable_type'=>'App\Models\SubscriptionFaq',
            'contentable_id'=>$faq->id,
            'title_ru'=>$request->title_ru,
            'title_kz'=>$request->title_kz,
            'content_ru'=>$request->content_ru,
            'content_kz'=>$request->content_kz
        ]);
        return redirect('admin/subscription-faq');
    }
    public function edit($id){
        $item = \App\Models\SubscriptionFaq::find($id);
        return view('admin.subscription.faq.form',['action'=>'/admin/subscription-faq/'.$id,'item'=>$item]);
    }
    public function update(Request $request,$id){

        \App\Models\SubscriptionFaq::find($id)->update([
            'name'=>$request->name,
            'order'=>$request->order
        ]);
        \App\Models\Content::where('contentable_id',$id)->first()->update([
            'title_ru'=>$request->title_ru,
            'title_kz'=>$request->title_kz,
            'content_ru'=>$request->content_ru,
            'content_kz'=>$request->content_kz
        ]);
        return redirect('admin/subscription-faq');
    }
    public function destroy($id){


        \App\Models\SubscriptionFaq::find($id)->delete();

        \App\Models\Content::where('contentable_id',$id)->delete();
        return back();

    }
}
