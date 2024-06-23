<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Controllers\Api\ApiController;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends ApiController
{
    public function index(LoginRequest $request): JsonResponse
    {
        if (!Auth::attempt([...$request->validated()])) {
            return $this->errorResponse(
                'Invalid credentials',
                Response::HTTP_UNAUTHORIZED
            );
        }
        $user = User::firstWhere('email', $request->validated('email'));

        return $this->dataResponse(
            [
                'token' => $user->createToken(
                    'API token for ' . $user->email,
                    ['*'],
                    now()->addDays(10)
                )->plainTextToken
            ],
            Response::HTTP_OK,
            'Authenticated'
        );
    }
}
