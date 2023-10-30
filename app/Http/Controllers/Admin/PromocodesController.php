<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Promocodes;
use App\Classes\Promocode as PromoClass;

class PromocodesController extends Controller
{
    public function index()
    {
        $promos = Promocodes::all();
        return view('admin.promo.index', compact('promos'));
    }
    public function create()
    {
        $action='/admin/promocodes';
        return view('admin.promo.create',['action'=>$action]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'code' => 'required',
            'percentage' => 'required',
            'quantity' => 'required'
        ]);

        if(!$request->has('reuseable')){
            $request->merge(['reuseable' => 0]);
        }
        if(!$request->has('status')){
            $request->merge(['status' => 0]);
        }

        $promo = Promocodes::create([
            'title'=>$request->title,
            'code'=>$request->code,
            'percentage'=>$request->percentage,
            'reuseable'=>$request->reuseable,
            'status'=>$request->status
        ]);

        if($request->has('expire')){
            $promo->expire=$request->expire;
        }
        if($request->reuseable==0){
            $promo->quantity=1;
        }
        $promo->save();

        return redirect("/admin/promocodes");
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $action='/admin/promocodes/'.$id;
        $promocodes = Promocodes::find($id);
        return view('admin.promo.create' ,['promocodes'=>$promocodes,'action'=>$action]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'code' => 'required',
            'percentage' => 'required',
            'quantity' => 'required',
        ]);
        $promocodes = Promocodes::find($id);
        if(!$request->has('reuseable')){
            $request->merge(['reuseable' => 0]);
        }
        if(!$request->has('status')){
            $request->merge(['status' => 0]);
        }
        $promocodes->update($request->all());
        
        return redirect("/admin/promocodes");
    }
    public function destroy($id)
    {
       //
    }
    public function generate(Request $request){
        $promo = new PromoClass;
        return ['code'=>$promo->generate($request->length)];
    }
}
