<?php

/**
 * Created by Reliese Model.
 */

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Reliese\Database\Eloquent\Model;

/**
 * Class PermissionGroup
 * 
 * @property int $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Collection|Permission[] $permissions
 *
 * @package App
 */
class PermissionGroup extends Model
{
	protected $table = 'permission_groups';

	protected $fillable = [
		'name'
	];

	public function permissions()
	{
		return $this->hasMany(Permission::class);
	}
}
