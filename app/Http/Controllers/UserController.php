<?php

namespace App\Http\Controllers;


use App\Http\Requests\User\SignInRequest;
use App\Mappers\Requests\User\SignInDTO;
use App\Mappers\Requests\User\TestDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @param SignInRequest $request
     * @return JsonResponse
     * @throws \ReflectionException
     */
    public function signIn(SignInRequest $request): JsonResponse
    {
        $data = $request->mappedCollection();

        $token = \App\Models\User::find(1)->createToken("My_Test_Token")->plainTextToken;

        return response()->json([
            'token' => $token,
            'data'  => $data->toArray(),
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getToken(Request $request): JsonResponse
    {
        $token = \App\Models\User::find(1)->createToken($request->token_name);

        #$token = $request->user()->createToken($request->token_name);

        return response()->json([
            'token' => $token->plainTextToken,
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function info(Request $request): JsonResponse
    {
        $user    = Auth::user();
        $reqUser = $request->header('Authorization');

        return response()->json(['user' => $user, 'token' => $reqUser]);
    }
}
