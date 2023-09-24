<?php

namespace App\Http\Controllers;

use App\Http\Requests\SetUserRoleRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * #### `GET` `/api/users`
     */
    public function index(): JsonResponse
    {
        $this->authorize('index', User::class);

        return response()->json([
            'user' => $this->userRepository->getAllUsers(),
        ]);
    }

    /**
     * #### `POST` `/api/users`
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $this->authorize('store', User::class);

        $userDetails = $request->all();

        return response()->json([
            'user' => $this->userRepository->createUser($userDetails),
        ], Response::HTTP_CREATED);
    }

    /**
     * #### `PATCH` `/api/users/{user}`
     */
    public function update(User $user, UpdateUserRequest $request): JsonResponse
    {
        $this->authorize('update', User::class);

        $newUserDetails = $request->all();

        return response()->json([
            'user' => $this->userRepository->updateUser($user, $newUserDetails),
        ]);
    }

    /**
     * #### `DELETE` `/api/users/{user}`
     */
    public function destroy(User $user): JsonResponse
    {
        $this->authorize('destroy', User::class);

        $this->userRepository->deleteUser($user);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * #### `PATCH` `/api/users/{user}/set-role`
     */
    public function setRole(User $user, SetUserRoleRequest $request): JsonResponse
    {
        $this->authorize('setRole', User::class);

        return response()->json([
            'user' => $this->userRepository->setUserRole($user, $request->role),
        ]);
    }
}
