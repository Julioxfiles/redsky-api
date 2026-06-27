<?php

namespace App\Http\Controllers\Auth;

use RedSky\Http\Request;
use RedSky\Http\Response;
use RedSky\Security\Jwt\JwtService;
use App\Models\User;

class AuthController
{
    /**
     * LOGIN
     */

    public function login(Request $request)
    {
        if (!$request->filled('email') || !$request->filled('password')) {
            return response()->validationError([
                'email' => 'Email is required',
                'password' => 'Password is required'
            ]);
        }

        $email    = $request->string('email');
        $password = $request->string('password');

        $user = User::where('email', '=', $email)->first();

        if (!$user || !password_verify($password, $user->password_hash)) {
            return Response::error('Invalid credentials', 401);
        }

        // 🔥 JWT GENERATION
        $jwt = new JwtService(config('jwt.secret'));

        $token = $jwt->encode([
            'sub'  => $user->id,
            'email'=> $user->email,
            'role' => $user->role
        ]);

        return Response::ok([
            'token' => $token,
            'user' => [
                'id'    => $user->id,
                'email' => $user->email,
                'role'  => $user->role,
            ]
        ], 'Login successful');
    }

    /**
     * REGISTER
     */
    public function register(Request $request)
    {
        // Validar campos requeridos
        if (!$request->filled('email') || !$request->filled('password')) {
            return response()->validationError(
                [
                    'email'    => 'Email is required',
                    'password' => 'Password is required',
                ],
                'Validation failed'
            );
        }

        $email    = $request->string('email');
        $password = $request->string('password');

        // Verificar si ya existe
        $exists = User::where('email', '=', $email)->first();

        if ($exists) {
            return Response::validationError(
                ['email' => 'Email already exists'],
                'Validation failed'
            );
        }

        // Crear usuario
        $user = User::create([
            'id'            => uuid(),
            'email'         => $email,
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            'role'          => 'user',
        ]);

        return Response::created([
            'id'    => $user->id,
            'email' => $user->email,
            'role'  => $user->role,
        ], 'User registered successfully');
    }
}