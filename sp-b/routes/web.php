<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthSaml2Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(session()->get('logoutToFront') == 1 && env('URL_LOGOUT_FRONT')) {
        session()->remove('logoutToFront');
        return redirect(env('URL_LOGOUT_FRONT'));
    }

    return view('welcome');
})->name("home");

Route::get('login/{loginToFront?}', [AuthSaml2Controller::class, 'toSaml2'])->name('login');
Route::get('logout/{logoutToFront?}', [AuthSaml2Controller::class, 'logoutSaml2'])->name('logout');

Route::prefix('admin')->middleware(["auth"])->group(function() {
    Route::get('/{loginToFront?}', function(){
        if(request()->route('loginToFront') == 1 && env('URL_LOGIN_FRONT')) {
            return redirect(env('URL_LOGIN_FRONT') . base64_encode((string) Auth::user()));
        }

        return view('admin');
    })->name('logado');

    Route::get('dashboard', function(){
        return view('dash');
    })->name('dash');
});