<?php

namespace App\SearchFilters\Sandbox\Filters;

class Taken_By
{
    public static function apply($builder, $value)
    {
        return $builder->whereHas('admin_user', function ($query) use ($value) {
            $query->where('id', $value);
        });
    }
}
