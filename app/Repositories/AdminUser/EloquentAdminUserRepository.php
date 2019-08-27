<?php

namespace App\Repositories\AdminUser;
use Illuminate\Support\Str;
use App\AdminUser;
use App\Http\Resources\UserResource;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Repositories\AdminUser\AdminUserInterface as UserInterface;
use App\Jobs\SendUserDetails;

use App\Mail\SendNewUserDetails;

class EloquentAdminUserRepository extends BaseRepository implements AdminUserInterface
{
    public $model;

    // set the protect model to the admin user
    // this will be used in the repository
    function __construct(AdminUser $model) {
        $this->model = $model;
    }

    /**
     * Create something new!
     * @param  array  $attributes [description]
     * @return [type]             [description]
     */
    public function create(array $attributes)
    {

        try{
            $user = $this->model->create([
                'first_name' => $attributes['first_name'],
                'last_name' => $attributes['last_name'],
                'email' => $attributes['email'],
                'password' => 'abc123',
                'role' => $attribures['role'],
                'api_token' => Str::random(60),
            ]);

            $user->syncRoles($attributes['role']['id']);

        } catch(Exception $e){
            return response()->error($e->message);
        }

        return response()->success('Your record has been created');
    }

    /**
     * Update the model
     * @param  [type] $id         [description]
     * @param  array  $attributes [description]
     * @return [type]             [description]
     */
    public function update($id, array $attributes)
    {
        try{

        	$user = $this->model->find($id);

          $user->update($attributes);

          if(isset($attributes['password'])){
              $user->password = Hash::make($attributes['password']);
              $user->save();
          }



        } catch(Exception $e){
            return response()->error($e->message);
        }


        try {
            $user->syncRoles($attributes['role']['id']);
        } catch(Exception $e){
            return response()->error($e->message);
        }


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
        foreach($attributes['id'] AS $attribute => $value){

          if($value === 1){
            return response()->error('You cannot delete an admin account!');
          }else{
            // check if its the super admin account
            if($this->model->isSuperAdmin($value)){
                continue;
            }

            // let's try and find this item
            try{
                $item = $this->getById($value);
            } catch(Exception $e){
                return response()->error($e->message);
            }


            // let's try and delete the id we found
            try{
                $item->delete();
            } catch(Exception $e){
                return response()->error($e->message);
            }
          }


        }

        // everything is fine, carry on sir!
        return response()->success('Your records has been deleted');
    }


}
