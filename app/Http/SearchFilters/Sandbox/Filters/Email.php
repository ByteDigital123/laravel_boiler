<?php

namespace App\SearchFilters\Sandbox\Filters;

use App\SearchFilters\Sandbox\Filter;

class Email implements Filter
{
    public static function apply($builder, $value)
    {
        return $builder->where('email', $value);
    }
}
