<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request;
use App\Http\Requests\User\SignInRequest;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function signIn(SignInRequest $request): JsonResponse
    {
        $data = $request->mappedCollection();
        $token = 'Test';

        return response()->json([
            'token' => $token,
            'data' => $data->get()
        ]);
    }

    public function getToken(Request $request): JsonResponse
    {
        $token = \App\Models\User::find(1)->createToken($request->token_name);
        #$token = $request->user()->createToken($request->token_name);

        return response()->json([
            'token' => $token->plainTextToken
        ]);
    }
}
