<?php

namespace App\SearchFilters\AdminUser\Filters;

class To
{
    public static function apply($builder, $value)
    {
        return $builder->where('updated_at', '<=', $value);
    }
}
