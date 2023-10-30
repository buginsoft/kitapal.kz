<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function __invoke($id)
    {
        $collection = \App\Models\Collection::find($id);
        $books = \App\Models\Collection::find($id)->books()->paginate(18);
        $page_title = $collection['collection_name_'.\App::getLocale()];
        return view('front.collection', compact('collection','page_title','books'));
    }
}
