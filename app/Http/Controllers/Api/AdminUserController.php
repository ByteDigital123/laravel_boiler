<?php

namespace App\Http\Controllers\Api;

use App\AdminUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\SearchFilters\AdminUser\AdminUserSearch;
use App\Repositories\AdminUser\AdminUserInterface;
use App\Http\Resources\Api\AdminUser\AdminUserResource;
use App\Http\Requests\Api\AdminUser\StoreAdminUserRequest;

class AdminUserController extends Controller
{
    protected $user;

    public function __construct(AdminUserInterface $user)
    {
        $this->user = $user;
        //$this->authorizeResource(AdminUser::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('list', Auth::user());
        return AdminUserResource::collection(AdminUserSearch::apply($request));
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
    public function store(StoreAdminUserRequest $request)
    {
        $this->authorize('create', Auth::user());

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
        $this->authorize('view', Auth::user());
        return new AdminUserResource($this->user->getById($id));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $this->authorize('update', Auth::user());
        $user = AdminUser::find($id);
        return $this->user->update($user, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->authorize('delete', Auth::user());
        $attributes = $request->json()->all();

        return $this->user->destroy($attributes);
    }
}
