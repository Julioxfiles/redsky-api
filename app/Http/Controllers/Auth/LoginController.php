<?php

namespace RedSky\Api\Http\Controllers\Auth;

use RedSky\Framework\Http\Request;
use RedSky\Framework\Http\Response;
use RedSky\Framework\Security\JwtService;
use RedSky\Api\Models\User;

class LoginController
{
    public function login(Request $request): Response
    {
        // Validar input
        if (!$request->filled('email') || !$request->filled('password')) {
            return (new Response::validationError([
                'email'    => 'Email is required',
                'password' => 'Password is required',
            ]);
        }

        $email    = $request->string('email');
        $password = $request->string('password');

        // Buscar usuario
        $user = User::where('email', $email)->first();

        if (!$user) {
            return (new Response::unauthorized('Invalid credentials'));
        }

        // Verificar password
        if (!password_verify($password, $user->password)) {
            return (new Response::unauthorized('Invalid credentials'));
        }

        // Generar token
        $jwt = new JwtService(env('JWT_SECRET'));

        $token = $jwt->encode([
            'sub'   => $user->id,
            'email' => $user->email,
            'role'  => $user->role,
        ]);

        return (new Response::ok([
            'token' => $token,
            'user'  => [
                'id'    => $user->id,
                'email' => $user->email,
                'role'  => $user->role,
            ],
        ]);
    }
}