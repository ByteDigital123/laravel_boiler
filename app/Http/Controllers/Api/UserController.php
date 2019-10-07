<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\Api\UserResource;
use App\Repositories\User\UserInterface;
use App\Http\Requests\Api\User\UpdateUserRequest;
use App\Http\Requests\Api\User\StoreUserRequest;

class UserController extends Controller
{
    protected $model;

    public function __construct(UserInterface $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('list', User::class);
        return UserResource::collection(UserSearch::apply($request));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorize('create', UserController::class);

        $attributes = $request->all();

        return $this->model->create($attributes);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view', UserController::class);
        return new UserResource($this->model->getById($id));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $this->authorize('update', UserController::class);

        $attributes = $request->all();

        return $this->model->updateById($id, $attributes);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->authorize('delete', UserController::class);
        
        $attributes = $request->json()->all();

        return $this->model->deleteMultipleById($attributes);
    }
}
