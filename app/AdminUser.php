<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use App\Http\Resources\Permission\PermissionResource;
use Illuminate\Foundation\Auth\User as Authenticatable;


class AdminUser extends Authenticatable
{
    use Notifiable, HasApiTokens, HasRoles;

    protected $guard_name = 'admin_api';

    public $table = 'admin_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password'
    ];

    /**
     * Cast some things to other things
     * @var [type]
     */
    protected $casts = [
        'is_admin' => 'boolean',
        'roles' => 'array',
        'permissions' => 'array'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function AauthAcessToken(){
        return $this->hasMany('\App\OauthAccessToken');
    }

    /**
     * Return all the permissions the model has, both directly and via roles.
     * @return [type] [description]
     */
    public function getAllPermissions()
    {
        return $this->permissions
            ->merge($this->getPermissionsViaRoles())
            ->sort()
            ->values();
    }

    /**
     * Check if the user is Super Admin
     * (well, right now it's just hardcoded for id:1)
     * #Spaghetti
     * ---------- What the fuck is going on here! ---------
     * @param  [type]  $value [description]
     * @return boolean        [description]
     */
    public function isSuperAdmin($value){
       if($value === 1){
            return true;
       }else{
         return false;
       }
    }


}
