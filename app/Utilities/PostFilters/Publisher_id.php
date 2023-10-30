<?php

namespace App\Utilities\PostFilters;

use App\Utilities\FilterContract;

class Publisher_id implements FilterContract
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function handle($value): void
    {
        $this->query->where('publisher_id',$value);;
    }
}
