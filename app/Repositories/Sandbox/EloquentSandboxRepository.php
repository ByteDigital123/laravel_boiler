<?php

namespace App\Repositories\Sandbox;

use App\Repositories\Sandbox\SandboxInterface;
use App\Sandbox;
use App\Repositories\BaseRepository;

class EloquentSandboxRepository extends BaseRepository implements SandboxInterface
{
    public $model;

    function __construct(Sandbox $model) {
        $this->model = $model;
    }
}
