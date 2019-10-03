<?php

namespace App\SearchFilters\Sandbox\Filters;

use App\SearchFilters\Filter;

class FilterClass implements Filter
{
    public static function apply($builder, $filter, $value)
    {
        return $builder->orWhere(strtolower($filter), 'like', '%' . $value . '%');
    }
}
