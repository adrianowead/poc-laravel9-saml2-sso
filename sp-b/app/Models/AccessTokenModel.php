<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccessTokenModel extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'access_token_spb';
    protected $primaryKey = 'token';
    public $incrementing = false;

    public static function newToSession(): AccessTokenModel
    {
        if(!Auth::check()) throw new AuthenticationException();

        $token = new AccessTokenModel;
        $token->token = Hash::make(Auth::user()->id);
        $token->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $token->expire_at = Carbon::now()->addMinutes('30')->format('Y-m-d H:i:s');
        $token->user_id = Auth::user()->id;

        $token->save();

        return $token;
    }

    public static function isTokenValid(string $token): bool
    {
        return self::whereToken($token)
            ->where('expire_at', '>', Carbon::now()->format('Y-m-d H:i:s'))
            ->count() == 1;
    }
}
