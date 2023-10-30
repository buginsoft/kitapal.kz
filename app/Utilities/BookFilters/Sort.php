<?php

namespace App\Utilities\BookFilters;

use App\Utilities\FilterContract;

class Sort implements FilterContract
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function handle($value): void
    {

        if($value=='new'){
            $this->query->orderBy('created_at','desc');
        }
        elseif($value=='best'){
            $this->query->orderBy('bought_count','desc');
        }
        elseif($value=='min'){
            $this->query->orderBy('paperbook_price','asc');
        }
        elseif($value=='max'){
            $this->query->orderBy('paperbook_price','desc');
        }
        elseif($value=='alphabet'){
            $this->query->orderBy('book_name','asc');
        }
    }
}
