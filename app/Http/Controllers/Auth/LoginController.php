<?php

namespace App\Http\Controllers\Auth;

use RedSky\Http\Request;
use RedSky\Http\Response;
use RedSky\Security\Jwt\JwtService;
use App\Models\User;

class LoginController
{
    public function login(Request $request): Response
    {
        // Validar input
        if (!$request->filled('email') || !$request->filled('password')) {
            return Response::validationError([
                'email'    => 'Email is required',
                'password' => 'Password is required',
            ]);
        }

        $email    = $request->string('email');
        $password = $request->string('password');

        // Buscar usuario
        $user = User::where('email',"=", $email)->first();

        if (!$user) {
            return Response::unauthorized('Invalid credentials');
        }

        // Verificar password
        if (!password_verify($password, $user->password)) {
            return Response::unauthorized('Invalid credentials');
        }

        // Generar token
        $jwt = new JwtService(env('JWT_SECRET'));

        $token = $jwt->encode([
            'sub'   => $user->id,
            'email' => $user->email,
            'role'  => $user->role,
        ]);

        return Response::ok([
            'token' => $token,
            'user'  => [
                'id'    => $user->id,
                'email' => $user->email,
                'role'  => $user->role,
            ],
        ]);
    }
}