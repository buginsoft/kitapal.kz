<?php namespace App\Classes;

class Robokassa
{
    /*боевой
    iD3dF8S5UxOpzO1CsJy6
    I8FmpZSFj3StJ3ZM9j2L
    тест
    F0Iok8Y3Y0L2eqNtxenf
    aNrCfU66p8F1um4HgQCy*/

    public function getLink($amount, $order_id, $recurring = false)
    {
        $IsTest = 0;
        $mrh_login = "kitapal";
        $mrh_pass1 = env('robokassa_pass1');

        $inv_id = $order_id;
        $inv_desc = "Книги";
        $out_summ = $amount;

        $crc = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1");

        $recurring = $recurring ? "&Recurring=true" : "";

        return "https://auth.robokassa.ru/Merchant/Index.aspx?MerchantLogin=" . $mrh_login . "&OutSum=" . $out_summ . "&InvoiceID=" . $inv_id . "&Description=" . $inv_desc . "&SignatureValue=" . $crc . "&IsTest=" . $IsTest . $recurring;
    }

    public function checkpayment()
    {
        $mrh_pass2 = env('robokassa_pass2');
        $out_summ = request()->OutSum;
        $inv_id = request()->InvId;
        $crc = strtoupper(request()->SignatureValue);

        $my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass2"));

        if ($my_crc == $crc) {
            return ['status' => true, 'inv_id' => $inv_id];
        } else {
            return ['status' => false];
        }
    }
}
