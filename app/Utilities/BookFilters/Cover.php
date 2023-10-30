<?php

namespace App\Utilities\BookFilters;

use App\Utilities\FilterContract;

class Cover implements FilterContract
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function handle($value): void
    {
        $this->query->where('cover',$value);
    }
}
