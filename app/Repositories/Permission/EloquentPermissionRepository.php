<?php

namespace App\Repositories\Permission;

use App\Repositories\Permission\PermissionInterface as PermissionInterface;
use App\Permission;
use App\Repositories\BaseRepository;

class EloquentPermissionRepository extends BaseRepository implements PermissionInterface
{
    public $model;

    public function __construct(Permission $model)
    {
        $this->model = $model;
    }
}
