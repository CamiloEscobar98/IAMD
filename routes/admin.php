<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\Localization\CountryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('login', [LoginController::class, 'login'])->name('admin.loggin');
Route::post('logout', [LoginController::class, 'logout'])->name('admin.loggout');

Route::get('profile', [HomeController::class, 'profile'])->name('admin.profile');

Route::patch('update-profile', [HomeController::class, 'update'])->name('admin.update-profile');
Route::patch('update-password', [HomeController::class, 'updatePassword'])->name('admin.update-password');

Route::get('home', [HomeController::class, 'home'])->name('admin.home');

Route::prefix('localizations')->group(function () {
    Route::resource('countries', CountryController::class, ['as' => 'admin.localizations']);
});
