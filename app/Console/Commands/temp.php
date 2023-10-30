<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class temp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:temp';

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
        foreach(\App\Models\Temp_user_books::all() as $user_book){
            if(\App\Models\Temp::find($user_book->ub_user_id) && \App\Models\Temp_books::find($user_book->ub_book_id)) {

                $temp_user = \App\Models\Temp::find($user_book->ub_user_id);
                $temp_book = \App\Models\Temp_books::find($user_book->ub_book_id);

                $user = \App\Models\User::where('email', $temp_user->email)->first();
                $book = \App\Models\Book::where('book_name', $temp_book->book_name)->first();
                if ($user){
                    if( $book){
                        if( \App\Models\UserBooks::where('ub_user_id', $user->user_id)->where('ub_book_id', $book->book_id)->count() == 0) {


                            $ub = \App\Models\UserBooks::create([
                                'ub_user_id' => $user->user_id,
                                'ub_book_id' => $book->book_id,
                                'type' => $user_book->type
                            ]);
                          
                        }
                    }
                    else{
                        echo 'knigi netu'.$temp_book->book_name;
                    }

                }
                else{
                    echo 'usera netu'.$temp_user->email;
                }
            }
        }
        echo 'done';
    }
}
