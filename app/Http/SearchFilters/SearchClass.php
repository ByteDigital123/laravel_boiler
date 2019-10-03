<?php

namespace App\SearchFilters\Filters;

class SearchClass
{
    public static function apply($builder, $filter, $value)
    {
        return $builder->orWhere(strtolower($filter), 'like', '%' . $value . '%');
    }
}
