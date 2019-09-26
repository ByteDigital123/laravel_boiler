<?php

namespace App\SearchFilters\Sandbox\Filters;

use App\SearchFilters\Sandbox\Filter;

class Name implements Filter
{
    public static function apply($builder, $value)
    {
        return $builder->where('name', $value);
    }
}
