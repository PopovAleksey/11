<?php

namespace App\Http\Controllers;


use App\Http\Requests\User\SignInRequest;
use App\Interfaces\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    public function __construct(
        private UserService $userService
    )
    {
    }

    /**
     * @param SignInRequest $request
     * @return JsonResponse
     */
    public function signIn(SignInRequest $request): JsonResponse
    {
        $data = $request->mappedCollection();

        $userService = $this->userService->singIn($data);

        return response()->json([
            'token' => $userService->createToken(),
            'data'  => $userService->getUser(),
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function info(Request $request): JsonResponse
    {
        $token = $request->header('Authorization');

        return response()->json([
            'user'  => Auth::user(),
            'token' => $token,
        ]);
    }
}
