<?php

namespace App\SearchFilters\Sandbox\Filters;

class To
{
    public static function apply($builder, $value)
    {
        return $builder->where('updated_at', '<=', $value);
    }
}
