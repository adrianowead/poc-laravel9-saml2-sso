<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Aacotroneo\Saml2\Saml2Auth;
use Illuminate\Support\Facades\Session;

class AuthSaml2Controller extends Controller
{
    public function toSaml2(Request $request)
    {
        if ($request->expectsJson())
        {
            return response()->json(['error' => 'Unauthenticated.'], 401); // Or, return a response that causes client side js to redirect to '/routesPrefix/myIdp1/login'
        }

        $saml2Auth = new Saml2Auth(Saml2Auth::loadOneLoginAuthFromIpdConfig('meuServicoMuitoLegal2'));
        return $saml2Auth->login(route('logado', ['loginToFront' => $request->route('loginToFront')]));
    }

    public function logoutSaml2(Request $request)
    {
        Session::put('logoutToFront', $request->route('logoutToFront'));

        return redirect("/saml2/meuServicoMuitoLegal2/logout");
    }
}
