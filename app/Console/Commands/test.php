<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes expired promocodes';

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
        $result = [];
        foreach(\App\Models\CustomerOrder::with('products')->with('products.book')->where('paid',1)->get() as $item){
            foreach($item->products as $tr){
                if(!$tr->book){
                    if (in_array($tr->user_id.' '.$tr->product_id, $result)) {

                    }
                    else{
                        array_push($result,$tr->user_id.' '.$tr->product_id);
                    }
                }
            }
        }

      /*  $text ='';
        foreach($result as $fdf){
            $text=$text.','.$fdf;
        }
        dd($text);*/
        dd($result);
    }
}
