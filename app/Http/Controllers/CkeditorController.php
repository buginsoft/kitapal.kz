<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CkeditorController extends Controller
{
    
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName .'.'. $extension;
            $url = newStoreImg($request->file('upload'), 'image', $request);
            return response()->json([
                'uploaded' => 1,
                'fileName' => $fileName,
                'url' => $url
            ]);
        }
    }
}
