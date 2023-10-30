<?php

use Illuminate\Database\Seeder;

use App\Models\Book;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $book=Book::create([
            'book_name' =>Faker\Provider\Lorem::sentence($nbWords = 3, $variableNbWords = true),
            'book_image' =>'http://kokj.kz/media/2020/01/15/1530779971-dugalar_jinagy-2018.png',
            'book_description' => Faker\Provider\Lorem::text(200),
            'audio_size' =>0,
            'audio_length' =>0,
            'book_lang' =>'ru',
            'book_collection_id' =>Faker\Provider\Base::numberBetween($min = 10, $max = 12),
            'book_views' =>0,
            'isbn' =>Faker\Provider\Base::numberBetween($min = 1000, $max = 9000),
            'available' =>1,
            'year' =>2019,
            'page_quanity' =>Faker\Provider\Base::numberBetween($min = 100, $max = 400),
            'paperbook_price' =>Faker\Provider\Base::numberBetween($min = 1000, $max = 9000),
            'ebook_price' =>Faker\Provider\Base::numberBetween($min = 1000, $max = 9000),
            'audio_price' =>Faker\Provider\Base::numberBetween($min = 1000, $max = 9000)
        ]);

        DB::table('book_genres')->insert([
            'bg_book_id' =>$book->book_id,
            'bg_genre_id' =>Faker\Provider\Base::numberBetween($min = 1, $max = 6)
        ]);
    }
}
