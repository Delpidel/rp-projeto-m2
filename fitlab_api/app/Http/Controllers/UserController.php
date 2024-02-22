<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function store(Request $request)
    {
        try {
            $data = $request->all();

            $request->validate([
                'name' => 'string|required|max:255',
                'email' => 'string|required|email|max:255|unique:users',
                'cpf' => 'string|required|max:14|unique:users',
                'password' => 'string|required|min:8|max:32',
            ]);

            $user = User::create($data);

            return response()->json($user->only(['id', 'name', 'email', 'cpf']), Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
