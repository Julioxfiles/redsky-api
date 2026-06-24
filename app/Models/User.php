<?php
declare(strict_types=1);

namespace RedSky\Api\Models;

use RedSky\Framework\Models\Model;

class User extends Model
{
    protected string $table = 'users';

    protected array $hidden = [
        'password_hash'
    ];

    protected array $fillable = [
        'name',
        'email',
        'password_hash'
    ];

    public static function byEmail(string $email): ?self
    {
        return static::query()
            ->where('email', '=', $email)
            ->first();
    }
}