<?php

namespace App\Repositories\AdminUser;

use App\AdminUser;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;

class EloquentAdminUserRepository extends BaseRepository implements AdminUserInterface
{
    public $model;

    // set the protect model to the admin user
    // this will be used in the repository
    public function __construct(AdminUser $model)
    {
        $this->model = $model;
    }

    /**
     * Create something new!
     * @param  array  $attributes [description]
     * @return [type]             [description]
     */
    public function create(array $attributes)
    {
        Db::transaction(function () use ($attributes) {
            $user = $this->model->create([
                'first_name' => $attributes['first_name'],
                'last_name' => $attributes['last_name'],
                'email' => $attributes['email'],
                'password' => Hash::make($attributes['password'])
            ]);

            $user->givePermissionTo(array_map(function ($permission) {
                return $permission['name'];
            }, $attributes['permissions']));
        });

        return response()->success('The user has been created');
    }

    /**
     * Update the model
     * @param  [type] $id         [description]
     * @param  array  $attributes [description]
     * @return [type]             [description]
     */
    public function update($id, array $attributes)
    {
        Db::transaction(function () use ($attributes) {
            $user = $this->model->find($id);

            $user->update($attributes);

            if (isset($attributes['password'])) {
                $user->password = Hash::make($attributes['password']);
                $user->save();
            }

            $user->givePermissionTo(array_map(function ($permission) {
                return $permission['name'];
            }, $attributes['permissions']));
        });


        return response()->success('Your record has been updated');
    }

    /**
     * DESTROY ALL HUMANS!!!!
     * @param  array  $attributes [description]
     * @return [type]             [description]
     */
    public function destroy(array $attributes)
    {
        // let's go through the array of id's and delete them
        foreach ($attributes['id'] as $attribute => $value) {
            if ($value === 1) {
                return response()->error('You cannot delete an admin account!');
            } else {
                // check if its the super admin account
                if ($this->model->isSuperAdmin($value)) {
                    continue;
                }

                // let's try and find this item
                try {
                    $item = $this->getById($value);
                } catch (Exception $e) {
                    return response()->error($e->message);
                }


                // let's try and delete the id we found
                try {
                    $item->delete();
                } catch (Exception $e) {
                    return response()->error($e->message);
                }
            }
        }

        // everything is fine, carry on sir!
        return response()->success('Your records has been deleted');
    }
}
