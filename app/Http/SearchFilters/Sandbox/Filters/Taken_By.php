<?php

namespace App\SearchFilters\Sandbox\Filters;

class Taken_By
{
    public static function apply($builder, $value)
    {
        return $builder->admin_user()->where('id', $value);
    }
}
