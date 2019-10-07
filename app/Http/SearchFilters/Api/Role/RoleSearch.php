<?php

namespace App\Http\SearchFilters\Api\Role;

use App\Role;
use App\SearchFilters\ApiSearchableTrait;

class RoleSearch
{
    protected static $model = Role::class;
    protected static $namespace = __NAMESPACE__;

    use ApiSearchableTrait;
}
