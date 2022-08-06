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

        if (in_array('admin', $guards)) return $this->redirectAdminHome($next, $request);

        if (in_array('web', $guards)) return $this->redirectClientHome($next, $request);
    }

    /**
     * Redirect if is authenticated Admin.
     * @param Closure $next
     * @param Request $request
     * 
     * @return mixed
     */
    private function redirectAdminHome($next, $request)
    {
        return Auth::guard('admin')->check() ?  redirect()->route('admin.home') : $next($request);
    }

    /**
     * Redirect if is authenticated Client.
     * 
     * @param Closure $next
     * @param Request $request
     * 
     * @return mixed
     */
    private function redirectClientHome($next, $request)
    {
        return Auth::guard()->check() ?  redirect()->route('client.home', ['client' => $request->client]) : $next($request);
    }
}
