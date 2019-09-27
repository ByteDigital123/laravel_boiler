<?php

namespace App\SearchFilters\Sandbox\Filters;

use App\SearchFilters\Sandbox\Filter;

class Name implements Filter
{
    public static function apply($builder, $value)
    {
        return $builder->where(strtolower((new \ReflectionClass(get_called_class()))->getShortName()), 'like', '%' . $value . '%');
    }
}
