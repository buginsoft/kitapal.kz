<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use App\Models\UserSubscription;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

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
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //получение текущей даты и подписок с рекурентными платежами
        $current_date = Carbon::now()->format('Y-m-d');
        $subscriptions = UserSubscription::where('recurring', true)->get();

         /**
          * пробегаемся циклом по подпискам, если дата списание эдентична с текущей датой то
          * находим период подписки обновляем дату следующего рекурентного платежа
         */

        foreach ($subscriptions as $item)
        {
            if ($item->debiting_date == $current_date)
            {
                $subscription = Subscription::find($item->subscription_id);
                $item->debiting_date = Carbon::now()->addMonths($subscription->months);
            }

            $new_id = (int)(rand(1, 9999) . strtotime(date('y-m-d h:i:s')));
            $password = 'iD3dF8S5UxOpzO1CsJy6';
            $amount = $item->subscription->price;

            $response = Http::post('https://auth.robokassa.ru/Merchant/Recurring', [
                'MerchantLogin' => 'kitapal',
                'InvoiceID' => $new_id,
                'PreviousInvoiceID' => $item->order->order_id, // id предыдущего заказа (материнского платежа)
                'Description' => 'Оплата подписки',
                'SignatureValue' => md5("kitapal:$amount:$new_id:Receipt:$password:Shp=kitapalkz"), // Hash
                'OutSum' => $amount,
            ]);
        }

       return $response;
    }
}
