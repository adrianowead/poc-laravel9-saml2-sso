<?php

namespace App\Http\Controllers;

use Illuminate\Auth\AuthenticationException;

class AuthSaml2Controller extends Controller
{
    public function toSaml2()
    {
        throw new AuthenticationException();
    }

    public function logoutSaml2()
    {
        return redirect('/saml2/nomeMeuSP/logout');
    }
}
