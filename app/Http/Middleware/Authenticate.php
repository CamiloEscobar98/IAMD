<?php

namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

use Closure;


class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        return $next($request);
    }

    /**
     * Determine if the user is logged in to any of the given guards.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function authenticate($request, array $guards)
    {
        if (empty($guards)) {
            $guards = [null];
        }

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if ($guard == 'web') {
                    $this->refreshRole();
                }
                return Auth::shouldUse($guard);
            }
        }

        $this->unauthenticated($request, $guards);
    }

    /**
     * Handle an unauthenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function unauthenticated($request, array $guards)
    {
        if (in_array('admin', $guards)) {
            throw new AuthenticationException(
                'Unauthenticated.',
                $guards,
                $this->adminRedirectTo($request)
            );
        } else {
            throw new AuthenticationException(
                'Unauthenticated.',
                $guards,
                $this->clientRedirectTo($request)
            );
        }
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function clientRedirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('client.login', ['client' => $request->client]);
        }
    }

    /**
     * Get the path the admin should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function adminRedirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('admin.login');
        }
    }

    protected function refreshRole()
    {
        /** @var \App\Models\Client\Role $currentRole */
        $currentRole = session('current_role');
        if ($currentRole->isClean()) {
            $currentRole->refresh();
            session('current_role', $currentRole);
        }
    }
}
