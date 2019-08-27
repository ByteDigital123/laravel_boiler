<?php

namespace App\Repositories\AdminUser;

interface AdminUserInterface {
    public function getAll();
    public function getById($id);
    public function create(array $attributes);
    public function update($id, array $attributes);
    public function destroy(array $attributes);
}
