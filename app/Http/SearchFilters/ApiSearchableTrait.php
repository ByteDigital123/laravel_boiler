<?php

namespace App\SearchFilters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

trait ApiSearchableTrait
{
    public static function apply(Request $filters)
    {
        $query = static::applyDecoratorsFromRequest($filters, (new self::$model)->newQuery());

        return $query->paginate($filters->paginate);
    }
    
    private static function applyDecoratorsFromRequest(Request $request, Builder $query)
    {
        $query = static::applySearchDecorators($request, $query);
        $query = static::applyFilterDecorators($request, $query);

        $query->orderBy($request->sort ? $request->sort : 'updated_at', $request->order ? $request->order : 'asc');

        //dd(\App\Helpers\Helpers::returnSqlWithBindings($query));
        return $query;
    }

    public static function applySearchDecorators(Request $request, Builder $query)
    {
        if ($value = $request->search) {
            foreach ((new self::$model)->searchable as $filterName) {
                $decorator = static::createSearchDecorator();
                if (static::isValidDecorator($decorator)) {
                    $query = $decorator::apply($query, $filterName, $request->search);
                }
            }
        }

        return $query;
    }

    public static function applyFilterDecorators(Request $request, Builder $query)
    {
        if ($request->filters) {
            foreach ($request->filters as $filterName => $value) {
                if ($value) {
                    $decorator = static::createFilterDecorator($filterName);
                    if (static::isValidDecorator($decorator)) {
                        $query = $decorator::apply($query, $value);
                    }
                }
            }
        }

        return $query;
    }


    public static function createSearchDecorator()
    {
        return SearchClass::class;
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
