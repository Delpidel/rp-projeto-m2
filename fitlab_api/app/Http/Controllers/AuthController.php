<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            return response()->json(['error' => 'Credenciais inválidas'], Response::HTTP_UNAUTHORIZED);
        }

        $token = auth()->user()->createToken('authToken')->accessToken->token;

        return response()->json(['token' => $token, 'name' => auth()->user()->name], Response::HTTP_CREATED);
    }
}
