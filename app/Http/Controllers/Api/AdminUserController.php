<?php

namespace App\Http\Controllers\Api;

use DB;
use Validator;
use App\AdminUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Api\AdminUser\AdminUserResource;
use App\Repositories\AdminUser\AdminUserInterface;
use App\Http\Requests\Api\AdminUser\UpdateAdminUserRequest;
use App\Http\Requests\AdminUser\StoreAdminUserRequest;

class AdminUserController extends Controller
{

    protected $user;

    public function __construct(AdminUserInterface $user){
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AdminUserResource::collection($this->user->all());
    }


    public function currentUser(Request $request)
    {
        return new AdminUserResource($request->user());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->all();

        return $this->user->create($attributes);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new AdminUserResource($this->user->getById($id));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateAdminUserRequest $request)
    {
        $attributes = $request->all();

        return $this->user->update($id, $attributes);
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

        return $this->user->destroy($attributes);
    }


}
