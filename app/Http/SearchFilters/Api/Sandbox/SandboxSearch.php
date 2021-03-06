<?php

namespace App\SearchFilters\Api\Sandbox;

use App\Sandbox;
use App\SearchFilters\ApiSearchableTrait;

class SandboxSearch
{
    protected static $model = Sandbox::class;
    protected static $namespace = __NAMESPACE__;

    use ApiSearchableTrait;
}
