<?php

namespace App\Http\Controllers\Auth;

use RedSky\Http\Request;
use RedSky\Http\Response;

class LogoutController
{
    public function logout(Request $request): Response
    {
        // En JWT stateless normalmente el cliente elimina el token.
        // Si luego implementas blacklist, aquí invalidas token.

        return (new Response::ok([
            'message' => 'Logged out successfully',
        ]);
    }
}