<?php

use seeder;
use Faker;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        DB::table('books')->insert([
            'book_name' =>sentence($nbWords = 3, $variableNbWords = true),
            'book_image' =>'http://kokj.kz/media/2020/01/15/1530779971-dugalar_jinagy-2018.png',
            'book_description' => text(200),
            'audio_size' =>0,
            'audio_length' =>0,
            'book_lang' =>'ru',
            'book_collection_id' =>numberBetween($min = 10, $max = 12),
            'book_views' =>0,
            	'isbn' =>numberBetween($min = 1000, $max = 9000),
               'available' =>1,
                'year' =>2019,
                'page_quanity' =>numberBetween($min = 100, $max = 400),
                'paperbook_price' =>numberBetween($min = 1000, $max = 9000),
                	'ebook_price' =>numberBetween($min = 1000, $max = 9000),
                    	'audio_price' =>numberBetween($min = 1000, $max = 9000)
        ]);
    }
}
