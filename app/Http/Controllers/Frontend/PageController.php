<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;

class PageController extends Controller
{
    public function index($page_id)
    {
        $page = Page::find($page_id);

        return view('page', compact('page'));
    }
}
