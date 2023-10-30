<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;


class BooksExport implements FromArray,WithHeadings,WithColumnWidths
{

    public function array(): array
    {
        $result = [];

        foreach(Book::with('genres')->get() as $book){
            $format = 'бумажная';
            if($book->ebook_path){
                $format=$format.',электронная';
            }
            if($book->audio_file){
                $format=$format.',аудио';
            }

           
            $genre = '';
            foreach($book->genres as $key=>$item){
                if ($key !== array_key_first($book->genres->toArray()) || $key !== array_key_last($book->genres->toArray())) {
                    $genre.=$item->genre_name_ru.',';
                }
                else{
                    $genre.=$item->genre_name_ru;
                }
            }
            //----------

            array_push($result,[
                $book->book_id,
                url('/').$book->book_image,
                $book->book_name,
                $format,
                $genre,
                $book->paperbook_price,
                $book->ebook_price,
                $book->audio_price,
                $book->sale_percentage
            ]);
        }

        return $result;
    }

    public function headings(): array
    {
        return ["id","Фото","Название", "Формат", "Жанр",'Цена бумаж','Цена элек','Цена аудио', 'Скидка'];
    }
    public function columnWidths(): array
    {
        return [
            'A' => 8,
            'B' => 50,
            'C' => 50,
            'D' => 27,
            'E' => 50,
            'F' => 13,
            'G' => 13,
            'H' => 13,
            'I' => 10,
        ];
    }

}
