<?php

namespace App\SearchFilters\Api\AdminUser;

use App\AdminUser;
use App\SearchFilters\ApiSearchableTrait;

class AdminUserSearch
{
    protected static $model = AdminUser::class;
    protected static $namespace = __NAMESPACE__;

    use ApiSearchableTrait;
}
