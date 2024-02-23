<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function store(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        $request->validate([
            'email' => 'string|required',
            'password' => 'string|required'
        ]);

        $authenticated = Auth::attempt($credentials);

        if (!$authenticated) return $this->error('Não foi possível realizar a autenticação', Response::HTTP_UNAUTHORIZED);

        $user = $request->user();
        $user->tokens()->delete();
        $token = $user->createToken('token');

        return $this->response('Autenticado com sucesso', Response::HTTP_OK, [
            'token' => $token->plainTextToken,
            'name' =>  $user->name,
        ]);
    }
}
