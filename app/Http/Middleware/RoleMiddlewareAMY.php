<?php

// =============================================================================
// FILE: app/Http/Middleware/RoleMiddlewareAMY.php
// Usage: ->middleware('role:admin')  or  ->middleware('role:admin,team_member')
// Register in bootstrap/app.php under ->withMiddleware()
// =============================================================================
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddlewareAMY
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        $userRole = $request->user()->role?->name;

        if (!in_array($userRole, $roles)) {
            abort(403, 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}







