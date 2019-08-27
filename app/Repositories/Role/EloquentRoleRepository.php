<?php

namespace App\Repositories\Role;


use App\Repositories\Role\RoleInterface as RoleInterface;
use Spatie\Permission\Models\Role;
use App\Repositories\BaseRepository;

class EloquentRoleRepository extends BaseRepository implements RoleInterface
{
    public $model;

    function __construct(Role $model) {
        $this->model = $model;
    }


    public function getAll()
    {
        return $this->model->get();
    }

    public function create(array $attributes)
    {
        try{

            $role = $this->model;
            $role->name = $attributes['name'];
            $role->save();

            $role->syncPermissions($attributes['permissions']);


        } catch(Exception $e){
            return response()->error($e->message);
        }

        return response()->success('Your record has been created');
    }

    public function update($id, array $attributes)
    {
        try{

        	$role = $this->model->find($id);
            $role->name = $attributes['name'];
            $role->save();


        	   $role->syncPermissions($attributes['permissions']);


        } catch(Exception $e){
            return response()->error($e->message);
        }

        return response()->success('Your record has been updated');
    }
}
