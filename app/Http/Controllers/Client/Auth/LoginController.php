<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;

use App\Traits\Client\Auth\AuthenticatesUsers;

class LoginController extends  Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
    }
}
