<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->only('home');
    }

    public function home()
    {
        return view('admin.pages.home');
    }
}
