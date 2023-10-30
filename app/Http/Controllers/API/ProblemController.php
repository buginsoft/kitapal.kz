<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Problem;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProblemController extends Controller
{
    public function setProblem(Request $request)
    {
        $user_sub = Problem::create([
            'sender_id' => Auth::user()->user_id,
            'problem_text' => $request->problem_text,
        ]);

        if ($user_sub){
            return response()->json(['success'=>'Success']);
        }else{
            return response()->json(['error'=>'Somthing went wrong']);
        }
    }

    public function setStatus(Request $request)
    {
        DB::table('fake')->where('id', 1)->update([
            'status' => $request->status,
            'version' => ($request->has('ver') ? $request->ver : null)
        ]);
        $status = DB::table('fake')->first();
        return response()->json(['status' => $status->status, 'version' => $status->version], 200);
    }

    public function getStatus()
    {
        $status = DB::table('fake')->first();
        return response()->json(['status' => $status->status, 'version' => $status->version], 200);
    }
}
