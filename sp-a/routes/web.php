<?php

use App\Http\Controllers\AuthSaml2Controller;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
})->name("home");

Route::get('login', [AuthSaml2Controller::class, 'toSaml2'])->name('login');
Route::get('logout', [AuthSaml2Controller::class, 'logoutSaml2'])->name('logout');

Route::prefix('admin')->middleware(["auth"])->group(function() {
    Route::get('/', function(){
        return view('admin');
    })->name('logado');

    Route::get('dashboard', function(){
        return view('dash');
    })->name('dash');
});