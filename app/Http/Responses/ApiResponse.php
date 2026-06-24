<?php
declare(strict_types=1);

namespace RedSky\Api\Http\Responses;

use RedSky\Framework\Http\Response;

class ApiResponse
{
    /* =========================================================
     | SUCCESS RESPONSES
     |========================================================= */

    public static function ok(mixed $data = null, string $message = 'OK'): Response
    {
        return Response::json([
            'success' => true,
            'status'  => 200,
            'message' => $message,
            'data'    => $data,
            'errors'  => [],
        ], 200);
    }

    public static function created(mixed $data = null, string $message = 'Created'): Response
    {
        return Response::json([
            'success' => true,
            'status'  => 201,
            'message' => $message,
            'data'    => $data,
            'errors'  => [],
        ], 201);
    }

    public static function noContent(): Response
    {
        return Response::noContent();
    }

    /* =========================================================
     | ERROR RESPONSES
     |========================================================= */

    public static function error(string $message, int $status = 400, array $errors = []): Response
    {
        return Response::json([
            'success' => false,
            'status'  => $status,
            'message' => $message,
            'data'    => null,
            'errors'  => $errors,
        ], $status);
    }

    public static function badRequest(string $message = 'Bad Request'): Response
    {
        return self::error($message, 400);
    }

    public static function unauthorized(string $message = 'Unauthorized'): Response
    {
        return self::error($message, 401);
    }

    public static function forbidden(string $message = 'Forbidden'): Response
    {
        return self::error($message, 403);
    }

    public static function notFound(string $message = 'Not Found'): Response
    {
        return self::error($message, 404);
    }

    public static function validationError(array $errors, string $message = 'Validation failed'): Response
    {
        return self::error($message, 422, $errors);
    }

    public static function serverError(string $message = 'Internal Server Error'): Response
    {
        return self::error($message, 500);
    }
}