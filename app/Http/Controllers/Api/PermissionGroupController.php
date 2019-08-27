<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PermissionGroup\PermissionGroupInterface;
use App\Http\Resources\PermissionGroup\PermissionGroupResource;
use App\Http\Requests\PermissionGroup\StorePermissionGroupRequest;
use App\Http\Requests\PermissionGroup\UpdatePermissionGroupRequest;

class PermissionGroupController extends Controller
{
     protected $permissionGroup;

    public function __construct(PermissionGroupInterface $permissionGroup){
        $this->permissionGroup = $permissionGroup;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PermissionGroupResource::collection($this->permissionGroup->all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermissionGroupRequest $request)
    {
        $attributes = $request->all();

        return $this->permissionGroup->create($attributes);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new PermissionGroupResource($this->permissionGroup->getById($id));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdatePermissionGroupRequest $request)
    {
        $attributes = $request->all();

        return $this->permissionGroup->update($id, $attributes);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $attributes = $request->json()->all();

        return $this->permissionGroup->destroy($attributes);
    }
}
