<?php

namespace App\SearchFilters\Sandbox\Filters;

class Taken_By
{
    public static function apply($builder, $value)
    {
        return $builder->whereHas('adminUser', function ($query) use ($value) {
            $query->where('id', $value);
        });
    }
}
