<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class promocode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:promocode';

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
        $promocodes = \App\Models\Promocodes::where([['status',1],['expire','<', date('Y-m-d')]])->get();
        foreach($promocodes as $item){
            $item->status=0;
            $item->save();
        }
    }
}
