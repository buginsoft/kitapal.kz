<?php namespace App\Classes;

class Walletone
{
    public function prepare($amount,$order_id,$success_url)
    {
        $key = "366833555a4e7962574768447853775575396b48364b624f4c715b";

        $fields = [
            'WMI_MERCHANT_ID' => 109272874365,
            'WMI_PAYMENT_AMOUNT' => $amount,
            'WMI_PAYMENT_NO' => $order_id,
            'WMI_CURRENCY_ID' => '398',
            'WMI_DESCRIPTION' => 'BASE64:' . base64_encode('Покупка книг'),
            'WMI_SUCCESS_URL' => $success_url,
            'WMI_FAIL_URL' => 'https://kitapal.kz/',
            'WMI_PTENABLED' => ['CashTerminalKZT', 'QiwiWalletKZT', 'CreditCardKZT'],
        ];

        foreach ($fields as $name => $val) {
            if (is_array($val)) {
                usort($val, "strcasecmp");
                $fields[$name] = $val;
            }
        }
        uksort($fields, "strcasecmp");
        $fieldValues = "";

        foreach ($fields as $value) {
            if (is_array($value))
                foreach ($value as $v) {
                    $v = iconv("utf-8", "windows-1251", $v);
                    $fieldValues .= $v;
                }
            else {
                $value = iconv("utf-8", "windows-1251", $value);
                $fieldValues .= $value;
            }
        }
        $signature = base64_encode(pack("H*", md5($fieldValues . $key)));
        $fields["WMI_SIGNATURE"] = $signature;

        return   $fields;
    }

    public function checkpayment($request){
        if (!$request->has("WMI_SIGNATURE")){
            $this->print_answer("Retry", "Отсутствует параметр WMI_SIGNATURE");
        }

        if (!$request->has("WMI_PAYMENT_NO")){
            $this->print_answer("Retry", "Отсутствует параметр WMI_PAYMENT_NO");
        }

        if (!$request->has("WMI_ORDER_STATE")){
            $this->print_answer("Retry", "Отсутствует параметр WMI_ORDER_STATE");
        }

        $skey = "366833555a4e7962574768447853775575396b48364b624f4c715b";
        $input = $request->all();

        $params = [];
        foreach ($input as $name => $value) {
            if ($name !== "WMI_SIGNATURE") $params[$name] = $value;
        }
        uksort($params, "strcasecmp");
        $values = "";
        foreach ($params as $name => $value) {
            $values .= $value;
        }

        $order = \App\Models\CustomerOrder::find($request->WMI_PAYMENT_NO);

        $signature = base64_encode(pack("H*", md5($values . $skey)));

        if ($request->WMI_SIGNATURE == $signature) {
            if (strtoupper($_POST["WMI_ORDER_STATE"]) == "ACCEPTED") {
                return ['success'=>true,'order'=>$order];
            }
            else {
                return ['success'=>false,'message'=>"Неверное состояние ". $_POST["WMI_ORDER_STATE"]];
            }
        }
        else {
            return ['success'=>false,'message'=>"Неверная подпись " . $_POST["WMI_SIGNATURE"]];
        }
    }
}
