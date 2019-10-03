<?php

namespace App\Helpers;

class Helpers
{
    public static function returnSqlWithBindings($query)
    {
        return vsprintf(str_replace('?', '%s', $query->toSql()), collect($query->getBindings())->map(function ($binding) {
            return is_numeric($binding) ? $binding : "'{$binding}'";
        })->toArray());
    }

    public static function getDistanceBetweenTwoPoints($latA, $lngA, $latB, $lngB)
    {
        $result =  \DB::select(
            \DB::raw('select ST_Distance_Sphere(point(:lonA, :latA),point(:lonB, :latB)) * 0.00621371192'),
            [
                'latA' => $latA,
                'lonA' => $lngA,
                'latB' => $latB,
                'lonB' => $lngB,
            ]
        );

        return array_values(get_object_vars($result[0]))[0];
    }
}
