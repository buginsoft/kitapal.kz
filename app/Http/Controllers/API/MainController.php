<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Article;
use App\Models\Slider;
use App\Models\Contact;
use App\Models\Collection;
use \Harimayco\Menu\Facades\Menu;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->has('lang')?$request->lang:'kz';
        $headers = apache_request_headers();
        $user_id = (isset($headers['authorization']))?auth()->guard('api')->user()->user_id:null;

        $collection = new \App\Http\Resources\CollectionResource($user_id,$lang,Collection::with('books')->orderBy('sort_num')->get());

        $articles = Article::orderBy('created_at','desc')->take(4)
            ->select('id','title_'.$lang.' as title','short_text_'.$lang.' as short_text','image')->get();
        $sliders = Slider::orderBy('sort_num')->where('slider_type','upper')
            ->select('book_id','catalog_id','collection_id','url_'.$lang.' as url','adaptive_image as slider_image','type' )
            ->get();

        $sliders = new \App\Http\Resources\SliderResource($sliders,$lang);


        foreach($articles as $item){
            $item->image=url('/').$item->image;
        }
        return [
            'success'=>true,
            'banner'=>$sliders,
            'collections'=>$collection,
            'articles'=>$articles
        ];
    }

    public function getPage(Request $request, $id){
        $page  = Page::where('id',$id)->select('page_content_'.$request->lang.' as page_content' )->first();
        return ['page'=>$page];
    }
    public function navigation(Request $request){
        if($request->lang=='ru'){
            $menuList = Menu::getByName('Меню в футере');
        }
        else{
            $menuList = Menu::getByName('Меню в футере(kz)');
        }
        foreach($menuList as $key=>$menu){
            $exploded_link = explode('/', $menu['link']);
            $id = end($exploded_link);
            $menuList[$key]['id']=$id;
        }
        $contacts = Contact::first();
        return ['menu'=>$menuList,'contacts'=>$contacts];
    }
    public function test(){
        dd("fg");
        $address = \App\Models\Address::where('user_id',\Auth::user()->user_id)->first();

        return view('text',compact('address'));
    }
    public function getOS(Request $request)
    {
        if(count($request->all())){
            \DB::table('os')->where('os', 'ios')->update([
                'status' => $request->iosstatus
            ]);
            \DB::table('os')->where('os', 'android')->update([
                'status' => $request->androidstatus
            ]);
        }
        $status = \DB::table('os')->get();
        return $status;
    }
    public function getOS2(Request $request)
    {
        if($request->filled('iosstatus')) {
            \DB::table('os2')->where('os', 'ios')->update([
                'status' => $request->iosstatus
            ]);
        }
        if($request->filled('androidstatus')){
            \DB::table('os2')->where('os', 'android')->update([
                'status' => $request->androidstatus
            ]);
        }
        $status = \DB::table('os2')->get();
        return $status;
    }

    public function getreadingbook(){

        dump('$request');
    }
}
