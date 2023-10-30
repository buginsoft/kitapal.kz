<?php namespace App\Classes;

class Robokassa
{

    //боевой
    //K2HnQ8B9gBPU92wgCYyX
    //muTEd0k7Q1WsZUg86uNu
    //тест
    //cMmp2S2oyMCbCr6Q8C1O
    //HM6WeXvdhEB1L0uZ15pK
    public function getLink($amount , $order_id)
    {
        $IsTest = 0;
        $mrh_login = "kitapal";
        $mrh_pass1 = env('robokassa_pass1');

        $inv_id = $order_id;
        $inv_desc = "Книги";
        $out_summ = $amount;
        $crc = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1");

        return "https://auth.robokassa.ru/Merchant/Index.aspx?MerchantLogin=".$mrh_login."&OutSum=".$out_summ."&InvoiceID=".$inv_id."&Description=".$inv_desc."&SignatureValue=".$crc."&IsTest=".$IsTest;
    }

    public function checkpayment(){

        $mrh_pass2 = env('robokassa_pass2');;
        $out_summ = $_REQUEST["OutSum"];
        $inv_id = $_REQUEST["InvId"];
        $crc = strtoupper($_REQUEST["SignatureValue"]);

        $my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass2"));


        if ($my_crc == $crc){
            return ['status'=>true,'inv_id'=>$inv_id];
        }
        else{
            return ['status'=>false];
        }

    }
}
