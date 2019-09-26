<?php

namespace App\SearchFilters\Sandbox;

use App\SearchFilters\SearchableTrait;

class SandboxSearch
{
    protected static $model = \App\Sandbox::class;

    use SearchableTrait;
}
