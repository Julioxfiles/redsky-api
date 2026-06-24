<?php

namespace RedSky\Api\Http\Controllers\Auth;

use RedSky\Framework\Http\Request;
use RedSky\Framework\Http\Response;

class LogoutController
{
    public function logout(Request $request): Response
    {
        // En JWT stateless normalmente el cliente elimina el token.
        // Si luego implementas blacklist, aquí invalidas token.

        return (new Response())->ok([
            'message' => 'Logged out successfully',
        ]);
    }
}