<?php

namespace App\Repositories\AdminUser;

use App\AdminUser;
use Illuminate\Support\Facades\DB;
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
        DB::transaction(function () use ($attributes) {
            $user = $this->model->create([
                'first_name' => $attributes['first_name'],
                'last_name' => $attributes['last_name'],
                'email' => $attributes['email'],
                'password' => Hash::make($attributes['password'])
            ]);

            $user->assignRole($attributes['role']['name']);
        });

        return response()->success('The user has been created');
    }

    /**
     * Update the model
     * @param  [type] $id         [description]
     * @param  array  $attributes [description]
     * @return [type]             [description]
     */
    public function update($adminUser, array $attributes)
    {
        DB::transaction(function () use ($adminUser, $attributes) {
            $adminUser->update([
                'first_name' => $attributes['first_name'],
                'last_name' => $attributes['last_name'],
                'email' => $attributes['email'],
                'password' => Hash::make($attributes['password'])
            ]);

            if (isset($attributes['password'])) {
                $adminUser->password = Hash::make($attributes['password']);
                $adminUser->save();
            }

            $adminUser->syncRoles($attributes['role']['name']);
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
