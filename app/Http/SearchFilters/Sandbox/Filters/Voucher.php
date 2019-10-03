<?php

namespace App\SearchFilters\Sandbox\Filters;

class Voucher
{
    public static function apply($builder, $value)
    {
        return $builder->where(strtolower((new \ReflectionClass(get_called_class()))->getShortName()), $value);
    }
}
