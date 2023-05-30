<?php

namespace App\Http\Middleware;

use Closure;
use Spatie\Permission\Exceptions\UnauthorizedException;

class  PermissionMiddleware
{

    public function handle($request, Closure $next, $permission, $guard = null)
    {
        /** @var \App\Models\Client\Role $currentRole */
        $currentRole = session('current_role');
        $authGuard = app('auth')->guard($guard);

        if ($authGuard->guest()) {
            throw UnauthorizedException::notLoggedIn();
        }

        $permissions = is_array($permission)
            ? $permission
            : explode('|', $permission);

        foreach ($permissions as $permission) {
            if ($authGuard->user()->hasRole($currentRole) && $currentRole->hasPermissionTo($permission)) {
                return $next($request);
            }
        }

        throw UnauthorizedException::forPermissions($permissions);
    }
}
