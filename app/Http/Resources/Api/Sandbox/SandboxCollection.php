<?php

namespace App\Http\Resources\Api\Sandbox;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SandboxCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
