<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use App\Models\UserSubscription;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class Recurring extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pay:recurring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Запускает рекурентные платежи';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * пробегаемся циклом по подпискам, если дата списание эдентична с текущей датой то
     * находим период подписки обновляем дату следующего рекурентного платежа
     */
    public function handle()
    {
        $current_date = Carbon::now()->format('Y-m-d');
        $subscriptions = UserSubscription::where('recurring', true)->get();

        foreach ($subscriptions as $item)
        {
            if ($item->debiting_date == $current_date) {
                $item->debiting_date = Carbon::now()->addMonths(Subscription::find($item->subscription_id)->months);
                $item->save();

                $id = (int)(rand(1, 9999) . strtotime(date('y-m-d h:i:s')));

                $this->curl($item, $id);
                $this->logs();
            }
        }
    }

    protected function curl($item, $new_id)
    {
        $data = array(
            'MerchantLogin' => 'kitapal',
            'InvoiceID' => $new_id,
            'PreviousInvoiceID' => $item->order->order_id,
            'Description' => 'Оплата подписки',
            'SignatureValue' => md5('kitapal:' . $item->subscription->price . ':' . $new_id . ':Receipt:' . config('app.robokassa_pass1') . ':Shp=kitapalkz'),
            'OutSum' => $item->subscription->price
        );

        $postData = json_encode($data);

        $ch = curl_init('https://auth.robokassa.ru/Merchant/Recurring');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($postData))
        );
        $response = curl_exec($ch);

        if (curl_errno($ch)) {dd(curl_error($ch));
            echo 'Ошибка cURL: ' . curl_error($ch);
        }

        curl_close($ch);

        $this->logs($response);
    }

    protected function logs($info = null)
    {
        if(!isset($info)) {
            Log::channel('payment')->info('Payment: complete');
        } else {
            Log::channel('payment')->info('Payment: error ' . json_encode($info));
        }
    }
}
