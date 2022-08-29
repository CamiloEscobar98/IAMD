<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Client\Auth\LoginController;

use App\Http\Controllers\Client\HomeController;

use App\Http\Controllers\Client\AdministrativeUnitController;
use App\Http\Controllers\Client\ResearchUnitController;

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

Route::get('login', [LoginController::class, 'showLoginForm'])->name('client.login');
Route::post('login', [LoginController::class, 'login'])->name('client.loggin');
Route::post('logout', [LoginController::class, 'logout'])->name('client.loggout');

Route::get('profile', [HomeController::class, 'profile'])->name('client.profile');

Route::get('home', [HomeController::class, 'home'])->name('client.home');

Route::resource('administrative_units', AdministrativeUnitController::class, ['as' => 'client']);

Route::resource('research_units', ResearchUnitController::class, ['as' => 'client']);
