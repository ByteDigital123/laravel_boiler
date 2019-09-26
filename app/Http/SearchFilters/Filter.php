<?php

namespace App\SearchFilters\Sandbox;

use Illuminate\Database\Eloquent\Builder;

interface Filter
{
    public static function apply(Builder $builder, $value);
}
