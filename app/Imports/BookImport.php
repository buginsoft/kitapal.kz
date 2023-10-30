<?php

namespace App\Imports;
use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

use Maatwebsite\Excel\Concerns\WithStartRow;
class BookImport implements ToModel, WithChunkReading,WithBatchInserts

{
    public function model(array $row)
    {
       if($book = \App\Models\Book::find($row[0])) {

            if($book->paperbook_price!=$row[5]){
                $book->paperbook_price = $row[5];
            }
            if($book->ebook_price!=$row[6]){
                $book->ebook_price = $row[6];
            }
            if($book->audio_price!=$row[7]){
                $book->audio_price = $row[7];
            }
            $book->save();
        }
    }

    public function chunkSize(): int
    {
        return 100;
    }
    public function batchSize(): int
    {
        return 100;
    }
}
