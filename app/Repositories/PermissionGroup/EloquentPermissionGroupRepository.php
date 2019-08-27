<?php

namespace App\Repositories\PermissionGroup;


use App\Repositories\PermissionGroup\PermissionGroupInterface as PermissionGroupInterface;
use App\PermissionGroup;
use App\Repositories\BaseRepository;

class EloquentPermissionGroupRepository extends BaseRepository implements PermissionGroupInterface
{
    public $model;

    function __construct(PermissionGroup $model) {
        $this->model = $model;
    }

    public function create(array $attributes)
    {
        try{
            $role = $this->model;
            $role->name = $attributes['name'];
            $role->save();

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
        	
        } catch(Exception $e){
            return response()->error($e->message);
        }

        return response()->success('Your record has been updated');
    }
}