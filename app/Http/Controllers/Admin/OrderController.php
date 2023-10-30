<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CustomerOrder;


class OrderController extends Controller
{

    public function index(Request $request)
    {
        $orders = CustomerOrder::orderBy('created_at' ,'desc')->where([['paid',1]])->paginate(10);

        if($request->has('delivery_type')){
            if($request->delivery_type!='all') {
                if($request->delivery_type=='null'){
                    $orders = CustomerOrder::orderBy('created_at','desc')
                        ->where('paid', 1)->whereNull('delivery_type')->paginate(10);
                }
                else{
                    $orders = CustomerOrder::orderBy('created_at','desc')
                        ->where([['paid', 1], ['delivery_type', $request->delivery_type]])->paginate(10);
                }

            }
        }
        if($request->has('order_id')){
            $order_id=$request->order_id;
            $orders = CustomerOrder::orderBy('created_at','desc')
                ->where([['paid', 1], ['order_id', $request->order_id]])->paginate(10);
            //CustomerOrder::where('is_seen',0)->update(['is_seen'=>1]);
            return view('admin.orders.index', compact('orders','order_id'));
        }

        CustomerOrder::where('is_seen',0)->update(['is_seen'=>1]);
        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        return view('admin.pages.pages-edit' , compact('page'));
    }

    public function store(Request $request)
    {

        $page = new Page();
        //Ru
        $page->page_name_ru = $request->page_name_ru;
        $page->page_content_ru = $request->page_content_ru;
        //Kz
        $page->page_name_kz = (!empty($request->page_name_kz)) ? $request->page_name_kz : $request->page_name_ru;
        $page->page_content_kz = (!empty($request->page_content_kz)) ? $request->page_content_kz : $request->page_content_ru;


        $page->save();

        return redirect('/admin/pages');
    }

    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $page = Page::find($id);

        return view('admin.pages.pages-edit', compact('page'));
    }

    public function update(Request $request, $id)
    {

        Page::where('id', $id)
            ->update([
                'page_name_ru' => $request->page_name_ru,
                'page_name_kz' => $request->page_name_kz,
                'page_content_ru' => $request->page_content_ru,
                'page_content_kz' => $request->page_content_kz
            ]);

        return redirect("/admin/pages");
    }
    public function destroy($id)
    {
        $page = Page::find($id);
        $page->delete();
    }
    public function changestatus(Request $request){
        $order = CustomerOrder::find($request->order_id);
        $order->is_delivered=$request->delivery_status;
        if($order->save()){
            return 'true';
        }
        else{
            return 'false';
        }
    }
    public function acceptOrder($order_id){
        $order = CustomerOrder::find($order_id);
        $order->update(['status_id'=>2]);
        $to_name = $order->user->user_name;
        $to_email = $order->user->email;

        if(app()->getLocale()=='ru'){
            $mail_subject = 'Заказ принят';
        }
        else{
            $mail_subject = 'Тапсырыс қабылданды';
        }
        \App\Http\Helpers::sendMail($mail_subject,$to_name,$to_email,'mails.orderaccepted', $order->order_id,[ 'name'=>$to_name ,'order_id' => $order->order_id ]);

        return back();
    }
    public function delivered($order_id){
        $order = CustomerOrder::find($order_id);
        $order->update(['status_id'=>3]);
        $to_name = $order->user->user_name;
        $to_email = $order->user->email;
        $mail_subject =app()->getLocale()=='ru'?'Заказ доставлен':'Тапсырыс жеткізілді';

        \App\Http\Helpers::sendMail($mail_subject,$to_name,$to_email,'mails.order_delivered', $order->order_id,[ 'name'=>$to_name ,'order_id' => $order->order_id ]);

        return back();
    }
    public function notpaid(Request $request){
        $orders = CustomerOrder::orderBy('created_at' ,'desc')->where([['paid',0]])->paginate(10);

        if($request->has('delivery_type')){
            if($request->delivery_type!='all') {
                if($request->delivery_type=='null'){
                    $orders = CustomerOrder::orderBy('created_at','desc')
                        ->where('paid', 0)->whereNull('delivery_type')->paginate(10);
                }
                else{
                    $orders = CustomerOrder::orderBy('created_at','desc')
                        ->where([['paid', 0], ['delivery_type', $request->delivery_type]])->paginate(10);
                }

            }
        }
        if($request->has('order_id')){
            $order_id=$request->order_id;
            $orders = CustomerOrder::orderBy('created_at','desc')
                ->where([['paid', 0], ['order_id', $request->order_id]])->paginate(10);
            //CustomerOrder::where('is_seen',0)->update(['is_seen'=>1]);
            return view('admin.orders.index', compact('orders','order_id'));
        }

        CustomerOrder::where('is_seen',0)->update(['is_seen'=>1]);
        return view('admin.orders.index', compact('orders'));
    }
}
