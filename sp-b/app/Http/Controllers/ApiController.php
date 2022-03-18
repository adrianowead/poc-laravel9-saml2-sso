<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditProfileRequest;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function editProfile(EditProfileRequest $request)
    {
        return ["message" => "Parabéns! Access token aceito, perfil 'editado' com sucesso! \o/ 🤓"];
    }
}
