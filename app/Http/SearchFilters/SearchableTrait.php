<?php

namespace App\SearchFilters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

trait SearchableTrait
{
    public static function apply(Request $filters)
    {
        $query = static::applyDecoratorsFromRequest($filters, (new self::$model)->newQuery());

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
        return self::$namespace . '\\Filters\\' .
            str_replace(' ', '', mb_convert_case($name, MB_CASE_TITLE, "UTF-8"));
    }
    
    private static function isValidDecorator($decorator)
    {
        return class_exists($decorator);
    }
}
