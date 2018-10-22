<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\DeleteUserRequest;
use App\Http\Requests\User\RestoreUserRequest;
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
        $this->middleware('auth');
    }

    public function auth()
    {
        $user = auth()->user();

        if (!$user->hasRole('admin') && !$user->client->active) {
            return response('', 401);
        }

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
        return UserResource::collection($this->userRepository->getAll($request->per_page ?? 20, true, sortedQuery($this->userRepository, $request, 'name')));
    }

    /**
     * Display a listing of the resource.
     *
     * @param ViewUserRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function trashed(ViewUserRequest $request)
    {
        return UserResource::collection($this->userRepository->getAll($request->per_page ?? 20, true, sortedQuery($this->userRepository, $request, 'name')->withTrashed()->whereNotNull('deleted_at')));
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
     * Restore the deleted user.
     *
     * @param RestoreUserRequest $request
     * @param  \App\User $user
     * @return UserResource
     */
    public function restore(RestoreUserRequest $request, $user)
    {
        return new UserResource($this->userRepository->restoreById($user, $user));
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
