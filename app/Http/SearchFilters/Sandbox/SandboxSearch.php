<?php

namespace App\SearchFilters\Sandbox;

use App\Sandbox;
use App\SearchFilters\SearchableTrait;

class SandboxSearch
{
    protected static $model = Sandbox::class;
    protected static $namespace = __NAMESPACE__;

    use SearchableTrait;
}
