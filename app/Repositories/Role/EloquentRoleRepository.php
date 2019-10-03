<?php

namespace App\Repositories\Role;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Repositories\BaseRepository;
use App\Repositories\Role\RoleInterface as RoleInterface;

class EloquentRoleRepository extends BaseRepository implements RoleInterface
{
    public $model;

    public function __construct(Role $model)
    {
        $this->model = $model;
    }


    public function getAll()
    {
        return $this->model->get();
    }

    public function create(array $attributes)
    {
        DB::transaction(function () use ($attributes) {
            $role = $this->model;
            $role->name = $attributes['name'];
            $role->save();

            $role->syncPermissions(array_map(function ($permission) {
                return $permission['name'];
            }, $attributes['permissions']));
        });
       

        return response()->success('Your role has been created');
    }

    public function update($id, array $attributes)
    {
        try {
            $role = $this->model->find($id);
            $role->name = $attributes['name'];
            $role->save();


            $role->syncPermissions(array_map(function ($permission) {
                return $permission['name'];
            }, $attributes['permissions']));
        } catch (Exception $e) {
            return response()->error($e->message);
        }

        return response()->success('Your role has been updated');
    }
}
