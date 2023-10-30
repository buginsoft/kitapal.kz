<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Publisher;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request , $catalog_id)
    {
        $genre = Genre::where('genre_id' , $catalog_id)->first();
        $publishers = Publisher::all();

        if($catalog_id==7){
            if(!is_null($request->sort)){
                $books = $genre->books()->with(['authors','main_image3','selected'])->filterBy($request->all());
            }
            else{
                $books = $genre->books()->with(['authors','main_image3','selected'])->filterBy($request->all())->orderBy('created_at','desc');
            }
        }
        else{
            $books = $genre->books()->with(['authors','main_image3','selected'])->filterBy($request->all())->orderBy('created_at','desc');
        }

        
        $books=$books->paginate(12);

        return view('catalog', compact('books','genre','publishers'));
    }
}
