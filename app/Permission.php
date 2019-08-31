<?php

/**
 * Created by Reliese Model.
 */

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Reliese\Database\Eloquent\Model;

/**
 * Class Permission
 *
 * @property int $id
 * @property string $name
 * @property string $label
 * @property string $guard_name
 * @property int $permission_group_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property PermissionGroup $permission_group
 * @property Collection|ModelHasPermission[] $model_has_permissions
 * @property Collection|Role[] $roles
 *
 * @package App
 */
class Permission extends Model
{
    protected $table = 'permissions';

    protected $casts = [
        'permission_group_id' => 'int'
    ];

    protected $fillable = [
        'name',
        'label',
        'guard_name',
        'permission_group_id'
    ];

    public function permission_group()
    {
        return $this->belongsTo(PermissionGroup::class);
    }

    public function model_has_permissions()
    {
        return $this->hasMany(ModelHasPermission::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_has_permissions');
    }
}
