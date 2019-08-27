<?php

namespace App\Http\Resources\Api\AdminUser;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

       return [
           'id' => $this->id,
           'email' => $this->email,
           'first_name' => $this->first_name,
           'last_name' => $this->last_name,
           'role' => $this->getRoleNames(),
           'isSuperAdmin' => $this->isSuperAdmin($this->id),
           'permissions' => $this->hasRole('Super Admin') ? ['ALL'] : $this->getPermissionsViaRoles()->pluck('name')
       ];
    }
}
