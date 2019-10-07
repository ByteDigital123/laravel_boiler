<?php

/**
 * Created by Reliese Model.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';

    protected $casts = [
        'permission_group_id' => 'int'
    ];

    protected $fillable = [
        'name',
        'label',
        'model',
        'guard_name',
        'permission_group_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
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

    public function getNameAttriute($value)
    {
        return str_slug($this->label);
    }

    public function setLabelAttribute($value)
    {
        $this->attributes['name'] = strtolower(str_replace(' ', '_', $value));
        $this->attributes['label'] = $value;
    }
}
