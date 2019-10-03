<?php

namespace App\SearchFilters\Sandbox\Filters;

use App\SearchFilters\Filter;

class Email implements Filter
{
    public static function apply($builder, $value)
    {
        return $builder->orWhere(strtolower((new \ReflectionClass(get_called_class()))->getShortName()), 'like', '%' . $value . '%');
    }
}
