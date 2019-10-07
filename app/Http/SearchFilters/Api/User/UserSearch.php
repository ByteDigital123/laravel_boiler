<?php

namespace App\Http\SearchFilters\Api\User;

use App\User;
use App\SearchFilters\ApiSearchableTrait;

class UserSearch
{
    protected static $model = User::class;
    protected static $namespace = __NAMESPACE__;

    use ApiSearchableTrait;
}
