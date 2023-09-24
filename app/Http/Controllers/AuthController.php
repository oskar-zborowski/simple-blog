<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\PasswordReminderRequest;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * #### `POST` `/api/login`
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if (! Auth::attemptWhen($request->all(), function (User $user) {
            return $user->hasRole([RoleEnum::EDITOR, RoleEnum::ADMIN]);
        })) {
            return response()->json([
                'error' => __('auth.failed'),
            ], Response::HTTP_UNAUTHORIZED);
        }

        /** @var User $user */
        $user = Auth::user();
        $token = $user->createAuthToken();

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    /**
     * #### `POST` `/api/register`
     */
    public function register(RegistrationRequest $request): JsonResponse
    {
        $user = User::create($request->all());
        $user->assignRole(RoleEnum::USER);

        Auth::login($user);

        /** @var User $user */
        $user = Auth::user();
        $token = $user->createAuthToken();

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    /**
     * #### `POST` `/api/forgot-password`
     */
    public function forgotPassword(PasswordReminderRequest $request): JsonResponse
    {
        $status = Password::sendResetLink([
            'email' => $request->email,
        ]);

        $httpStatus = $status === Password::PASSWORD_RESET
            ? Response::HTTP_OK
            : Response::HTTP_BAD_REQUEST;

        return response()->json([
            'status' => __($status),
        ], $httpStatus);
    }

    /**
     * #### `GET` `/api/reset-password/{token}`
     */
    public function resetPasswordView(string $token): JsonResponse
    {
        return response()->json([
            'token' => $token,
        ]);
    }

    /**
     * #### `POST` `/api/reset-password`
     */
    public function resetPassword(PasswordResetRequest $request): JsonResponse
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->update([
                    'password' => Hash::make($password),
                ]);

                event(new PasswordReset($user));
            }
        );

        $httpStatus = $status === Password::PASSWORD_RESET
            ? Response::HTTP_OK
            : Response::HTTP_BAD_REQUEST;

        return response()->json([
            'status' => __($status),
        ], $httpStatus);
    }
}
