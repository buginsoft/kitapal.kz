<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function __invoke(Request $request,$type){
        if($type=='book'){
            return Excel::download(new \App\Exports\BooksExport, 'book.xlsx');
        }
        else{
            return Excel::download(new \App\Exports\UsersExport($request->range), 'users.xlsx');
        }
    }

}
