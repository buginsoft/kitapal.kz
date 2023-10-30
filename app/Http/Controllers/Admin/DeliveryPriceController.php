<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DeliveryPrice;

class DeliveryPriceController extends Controller
{
    public function index()
    {
        $all=DeliveryPrice::all();
        return view('admin.deliveryprice.index',compact('all'));
    }
    public function create()
    {
       //
    }
    public function store()
    {
       //
    }
    public function show()
    {
        //
    }
    public function edit()
    {
        //
    }
    public function update(Request $request, $id)
    {
        $price = DeliveryPrice::find($id);
        $price->price = $request->price;
        $price->save();
    }
    public function destroy()
    {
        //
    }
}
