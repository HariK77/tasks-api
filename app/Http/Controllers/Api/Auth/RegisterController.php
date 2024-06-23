<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends ApiController
{
    public function index(RegisterRequest $request): JsonResponse
    {
        User::create([...$request->validated()]);
        return $this->successResponse(
            'Registration successful',
            Response::HTTP_CREATED
        );
    }
}
