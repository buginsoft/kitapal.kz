<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::first();
        return view('admin.contact.index', compact('contact'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'email'=>'required',
            'contact2'=>'required',
            'pickup_address_ru'=>'required',
            'pickup_address_kz'=>'required'
        ]);

        $contact = Contact::first();
        $contact->update($request->except('_token','_method'));

        return redirect()->back();
    }
}
