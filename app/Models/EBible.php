<?php
declare(strict_types=1);

namespace App\Models;

use RedSky\Framework\Database\Model;

class EBible extends Model
{
    protected string $table = 'ebible';

    protected array $hidden = [
        'password_hash'
    ];

    protected array $fillable = [
        'name',
        'email',
        'password_hash'
    ];

    /*
    public static function byEmail(string $email): ?self
    {
        return static::query()
            ->where('email', '=', $email)
            ->first();
    }
    */
}