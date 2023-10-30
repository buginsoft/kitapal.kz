<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class checksub extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:checksub';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check subscription expiration';

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

        foreach(\App\Models\UserSubscription::where('active',1)->get() as $subscription){
            if($subscription->final_date<\Carbon\Carbon::now()){
                $subscription->active=0;
                $subscription->save();
            }
        }
    }
}
