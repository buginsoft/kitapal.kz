<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Book;
use App\Http\Helpers;
use App\Models\UserBooks;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;

class UsersController extends Controller
{

    public function index(Request $request)
    {
        if($request->has('s')){
            $users = User::where('user_name','like','%'.$request->s.'%')->orWhere('email','like','%'.$request->s.'%')->paginate(15);
        }
        else{
            $users = User::paginate(15);
        }

        return view('admin.users.users', compact('users'));
    }
    public function create()
    {
        return view('admin.users.users-edit');
    }
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:255|unique:users',
            'password' => 'required',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $result = Helpers::storeImg('avatar', 'avatar', $request);
        }

        User::create([
            'user_name' => $request->user_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'avatar' => $result,
            'user_role_id' => 0,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/admin/users');
    }
    public function show($id)
    {
        //
    }
    public function edit(User $user)
    {
        return view('admin.users.users-edit', compact('user'));
    }
    public function update(Request $request, User $user)
    {
        $request->validate([
            'email' => 'required',
            'phone' => 'required'
        ]);

        if ($request->hasFile('avatar')) {
            $result = Helpers::storeImg('avatar', 'avatar', $request);
        }else{
            $result = $user->avatar;
        }

        $user->update([
            'user_name' => $request->user_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'avatar' => $result,
            'password' => (!empty($request->password)) ? Hash::make($request->password) : $user->password
        ]);

        return redirect('/admin/users');
    }
    public function destroy(User $user)
    {
        $user->delete();
    }
    public function getUserEbooks(Request $request){
        $userebooks=User::find($request->user_id)->ebooks;
        $user_id=$request->user_id;
        $ebooks=Book::whereNotNull('ebook_path')->where('ebook_path', '<>', '')->pluck('book_name');
        $books = \App\Models\Book::whereNotNull('ebook_path')->where('ebook_path', '<>', '')->get();
        return view('admin.users.user_ebooks', compact('user_id','userebooks','ebooks','books'));
    }
    public function addEbookToUser(Request $request){

       if($request->action=='add'){
           if(!UserBooks::where('ub_user_id',$request->user_id)->where('ub_book_id',$request->book_id)->where('type','ebook')->first()) {
               UserBooks::create(['ub_user_id' => $request->user_id, 'ub_book_id' => $request->book_id, 'type' => 'ebook']);
           }
       }
       elseif($request->action =='delete'){
           if(UserBooks::where('ub_user_id',$request->user_id)->where('ub_book_id',$request->book_id)->where('type','ebook')->first()) {
               UserBooks::where('ub_user_id',$request->user_id)->where('ub_book_id',$request->book_id)->where('type','ebook')->first()->delete();
           }
       }
        $userebooks=User::find($request->user_id)->ebooks;
        return $userebooks;

    }

}
