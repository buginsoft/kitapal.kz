<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Problem;

class UserProblemController extends Controller
{

    public function index()
    {
        $problem = Problem::orderBy('problems.created_at', 'desc')->paginate(15);
        return view('admin.problem', compact('problem'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        Problem::find($id)->delete();
    }
}
