<?php

namespace App\SearchFilters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

trait ApiSearchableTrait
{
    public static function apply(Request $filters)
    {
        $query = static::applyDecoratorsFromRequest($filters, (new self::$model)->newQuery());

        return $query;
    }
    
    private static function applyDecoratorsFromRequest(Request $request, Builder $query)
    {
        if ($value = $request->search) {
            foreach ((new self::$model)->getSearchable() as $filterName) {
                $decorator = static::createFilterDecorator();

                if (static::isValidDecorator($decorator)) {
                    $query = $decorator::apply($query, $filterName, $value);
                }
            }
        }

        return $query;
    }
    
    private static function createFilterDecorator()
    {
        return self::$namespace . '\\Filters\\FilterClass';
    }
    
    private static function isValidDecorator($decorator)
    {
        return class_exists($decorator);
    }
}
