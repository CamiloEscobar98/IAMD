<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;

use App\Providers\RouteServiceProvider;

use App\Traits\Admin\Auth\AuthenticatesUsers;

class LoginController extends  Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::ADMIN_HOME;
}
