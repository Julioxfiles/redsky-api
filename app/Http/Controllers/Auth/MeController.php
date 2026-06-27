<?php

namespace App\Http\Controllers\Auth;

use RedSky\Http\Request;
use RedSky\Http\Response;
use RedSky\Security\JwtService;
use RedSky\Models\User;

class MeController
{
    public function me(Request $request): Response
    {
        // 1. Obtener token del header Authorization
        $authHeader = $request->header('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return (new Response())->unauthorized('Token not provided');
        }

        $token = trim(str_replace('Bearer', '', $authHeader));

        // 2. Decodificar JWT
        $jwt = new JwtService(env('JWT_SECRET'));

        try {
            $payload = $jwt->decode($token);
        } catch (\Exception $e) {
            return (new Response())->unauthorized('Invalid token');
        }

        // 3. Buscar usuario
        $user = User::find($payload->sub ?? null);

        if (!$user) {
            return (new Response())->notFound('User not found');
        }

        // 4. Respuesta
        return (new Response())->ok([
            'user' => [
                'id'    => $user->id,
                'email' => $user->email,
                'role'  => $user->role,
            ]
        ]);
    }
}