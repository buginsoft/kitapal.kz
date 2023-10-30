<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class StatisticController extends Controller
{

    public function dashboard(){
        //эта неделя
        $now = \Carbon\Carbon::now();
        $current_week = '[';
        $period = \Carbon\CarbonPeriod::since($now->startOfWeek())->days(1)->until($now->endOfWeek());
        foreach ($period as $date) {
            $current_week = $current_week.\App\Models\CustomerOrder::where('paid',1)->whereDate('created_at',$date->format('Y-m-d'))->count().',';
        }
        $current_week=substr($current_week, 0, -1);
        $current_week=$current_week.']';

        //прошлая неделя
        $last_monday = \Carbon\Carbon::parse(date('Y-m-d', strtotime('monday last week')))->format('Y-m-d H:i');
        $last_sunday = \Carbon\Carbon::parse(date('Y-m-d', strtotime('sunday last week')))->format('Y-m-d H:i');
        $last_week = '[';
        $period = \Carbon\CarbonPeriod::since($last_monday)->days(1)->until($last_sunday);
        foreach ($period as $date) {
            $last_week = $last_week.\App\Models\CustomerOrder::where('paid',1)->whereDate('created_at',$date->format('Y-m-d'))->count().',';
        }
        $last_week=substr($last_week, 0, -1);
        $last_week=$last_week.']';


        $top_selling =  \App\Models\Book::orderBy('bought_count','desc')->take(7)->get();
        $recent_orders = \App\Models\CustomerOrder::where('paid',1)->orderBy('created_at','desc')->take(7)->get();
        $messages  = \App\Models\Problem::orderBy('created_at','desc')->take(15)->get();

        //-----------------

        $categories  =  [];
        $category_text = '[';
        $category_value = '[';
        $category_text_ar=[];

        foreach(\App\Models\Book::where('bought_count','>',0)->get() as $item){
            foreach($item->genres as $genre){
                if (array_key_exists($genre->genre_name_ru, $categories)) {
                    $categories[$genre->genre_name_ru] = $categories[$genre->genre_name_ru]+$item->bought_count;
                }
                else{
                    $categories[$genre->genre_name_ru] = $item->bought_count;
                }
            }
        }
        foreach($categories as $key=>$value){
            $category_value=$category_value.$value.',';
            $category_text=$category_text."'".$key."',";
            array_push($category_text_ar,$key);
        }
        $category_value=substr($category_value, 0, -1);
        $category_text=substr($category_text, 0, -1);

        $category_text=$category_text.']';
        $category_value=$category_value.']';
        //dd($categories);
        //-----------------


        //---------Продажи по месяцам-----
        $month_sales = '[';
        $total_in_year_sales = 0;

        for($i=1; $i<date('m') ; $i++){

            $month_sale =\App\Models\CustomerOrder::where('paid',1)->whereMonth('created_at',$i)->whereYear('created_at',date('Y'))->count();
            $month_sales=$month_sales.$month_sale.',';
            $total_in_year_sales=$total_in_year_sales+$month_sale;
        }
        $month_sales=substr($month_sales, 0, -1);
        $month_sales=$month_sales.']';
        //-------------------------


        return view('admin.dashboard',compact('recent_orders','current_week','last_week','top_selling','messages','category_text_ar','category_text','category_value','month_sales','total_in_year_sales'));
    }

    public function booksSales(Request $request)
    {
     
        $books = \DB::table('books')
            ->leftJoin('order_products','books.book_id','=','order_products.product_id')
            ->join('customer_order','customer_order.order_id','=','order_products.order_id');

        if($request->type){
            $books->where('order_products.type',$request->type);
        }
        if($request->book_name){
            $books->where('books.book_name',$request->book_name);
        }
        if($request->from){
            $books->where('customer_order.created_at','>=',$request->from);
        }
        if($request->to){
            $books->where('customer_order.created_at','<=',$request->to);
        }

        $books = $books
            ->where('customer_order.paid',1)
            ->selectRaw('books.*, COALESCE(count(order_products.id),0) total , COALESCE(sum(order_products.unitprice),0) total_sum')
            ->groupBy('books.book_id')
            ->orderBy('total','desc')
            ->paginate(10);

        //сол аралыктагы толенген осы китап бар ордерпродактарды жинау . сонын санын юнитпрайсы болса юнит прайсын болмаса продуктын багасын есеке алып

        return view('admin.statistics', compact('books'));
    }
}
