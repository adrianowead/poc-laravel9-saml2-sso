<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;

    protected $table = 'tb_users';
    protected $primaryKey = 'id';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'email',
        'last_login',
    ];

    /**
     * Cria se não existir e retorna a instância
     */
    public static function createAndGet(array $fields): User
    {
        $user = self::whereId($fields['id'])->first();

        if(!$user) {
            self::insert($fields);
            $user = self::whereId($fields['id'])->first();
        }

        return $user;
    }
}