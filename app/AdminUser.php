<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
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
        'permissions' => 'array',
        'id' => 'integer'
    ];

    protected $with = [
        'permissions'
    ];

    public $searchable = [
        'first_name',
        'last_name',
        'email',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function permisions()
    {
        return $this->hasMany(Permission::class);
    }


    public function AauthAcessToken()
    {
        return $this->hasMany('\App\OauthAccessToken');
    }
}
