<?php

namespace App\SearchFilters\Sandbox;

use App\Sandbox;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class SandboxSearch
{
    public static function apply(Request $filters)
    {
        $query = static::applyDecoratorsFromRequest($filters, (new Sandbox)->newQuery());

        return $query;
    }
    
    private static function applyDecoratorsFromRequest(Request $request, Builder $query)
    {
        foreach ($request->all() as $filterName => $value) {
            if ($value) {
                $decorator = static::createFilterDecorator($filterName);

                if (static::isValidDecorator($decorator)) {
                    $query = $decorator::apply($query, $value);
                }
            }
        }

        return $query;
    }
    
    private static function createFilterDecorator($name)
    {
        return __NAMESPACE__ . '\\Filters\\' .
            str_replace(' ', '', ucwords(str_replace('_', ' ', $name)));
    }
    
    private static function isValidDecorator($decorator)
    {
        return class_exists($decorator);
    }
}
