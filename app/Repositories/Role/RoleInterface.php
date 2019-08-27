<?php

namespace App\Repositories\Role;

interface RoleInterface {
    public function getAll();
    public function getById($id);
    public function create(array $attributes);
    public function update($id, array $attributes);
}
