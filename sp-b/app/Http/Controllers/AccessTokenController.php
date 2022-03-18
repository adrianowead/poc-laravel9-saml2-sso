<?php

namespace App\Http\Controllers;

use App\Models\AccessTokenModel;
use App\Rules\AccessToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AccessTokenController extends Controller
{
    /**
     * Gera um access token avuslo para o usuário já logado
     */
    public function generate(Request $request)
    {
        if(!Auth::check())
        {
            return response("não autenticado", 400);
        }

        return response(AccessTokenModel::newToSession())
            ->withCookie(
                cookie(
                    name: 'access_token',
                    value: AccessTokenModel::newToSession(),
                    minutes: 29,
                    raw: true,
                    httpOnly: false
                )
            );
    }
}
