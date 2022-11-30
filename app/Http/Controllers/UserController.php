<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->userRepository->register($request->validated());
        $user = $this->userRepository->login($user);
        return  response()
            ->json([
                'message' => 'Successfully Registered',
                'data' =>  $user,
            ], Response::HTTP_OK);
    }

    public function login(LoginRequest $request): JsonResponse
    {

        if (!Auth::attempt($request->validated()))
            return response()->json([
                'message' => 'These credentials do not match our records.'
            ], Response::HTTP_FORBIDDEN);

        $user = $this->userRepository->login($request->user());

        return response()->json([
            'message' => 'Successfully logged in',
            'data' => $user,
        ], Response::HTTP_OK);
    }

    public function logout(Request $request)
    {
        $this->userRepository->logout($request->user());

        return response()->json([
            'message' => 'Successfully logged out'
        ], Response::HTTP_OK);
    }

    public function profile(Request $request)
    {
        return response()->json([
            'message' => 'Successfully',
            'data' => $request->user(),
        ], Response::HTTP_OK);
    }
}
