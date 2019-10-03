<?php

namespace App\SearchFilters\Sandbox\Filters;

class From
{
    public static function apply($builder, $value)
    {
        return $builder->where('created_at', '>=', $value);
    }
}