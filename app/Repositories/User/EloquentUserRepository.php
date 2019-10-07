<?php

namespace App\Repositories\User;

use App\Repositories\User\UserInterface;
use App\User;
use App\Repositories\BaseRepository;

class EloquentUserRepository extends BaseRepository implements UserInterface
{
    public $model;

    function __construct(User $model) {
        $this->model = $model;
    }
}
