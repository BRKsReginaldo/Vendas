<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\DeleteUserRequest;
use App\Http\Requests\User\ShowUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\ViewUserRequest;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('auth')->except('index');
    }

    public function auth()
    {
        $user = auth()->user();
        $user->load('roles');
        return new UserResource($user);
    }

    /**
     * Display a listing of the resource.
     *
     * @param ViewUserRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(ViewUserRequest $request)
    {
        return UserResource::collection($this->userRepository->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateUserRequest $request
     * @return UserResource
     */
    public function store(CreateUserRequest $request)
    {
        return new UserResource($this->userRepository->create($request->only([
            'name',
            'email',
            'password',
            'image',
            'phone'
        ])));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $user
     * @param ShowUserRequest $request
     * @return UserResource
     */
    public function show(User $user, ShowUserRequest $request)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param  \App\User $user
     * @return UserResource
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        return new UserResource($this->userRepository->updateByModel($user, $request->only([
            'name',
            'email',
            'password',
            'image',
            'phone'
        ])));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @param DeleteUserRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(User $user, DeleteUserRequest $request)
    {
        if (!$this->userRepository->deleteByModel($user)) abort(500);

        return response('', 200);
    }
}
