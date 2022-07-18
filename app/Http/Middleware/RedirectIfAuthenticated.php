<?php

namespace App\Http\Middleware;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Closure;

use App\Providers\RouteServiceProvider;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        if (in_array('admin', $guards)) return $this->redirectAdminHome();

        if (in_array('web', $guards)) return $this->redirectClientHome();

    }

    /**
     * Redirect if is authenticated Admin.
     * 
     * 
     * @return RedirectResponse
     */
    private function redirectAdminHome(): RedirectResponse
    {
        return Auth::guard('admin')->check() ?  redirect()->route('admin.home') : redirect('/admin/login');
    }

    /**
     * Redirect if is authenticated Client.
     * 
     * 
     * @return RedirectResponse
     */
    private function redirectClientHome(): RedirectResponse
    {
        return Auth::guard()->check() ?  redirect(RouteServiceProvider::HOME) : redirect('login');
    }
}
