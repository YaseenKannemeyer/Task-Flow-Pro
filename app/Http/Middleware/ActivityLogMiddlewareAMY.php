<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ActivityLogMiddlewareAMY
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->user()) {
            Log::channel('activity')->info('Request', [
                'user_id'    => $request->user()->id,
                'email'      => $request->user()->email,
                'method'     => $request->method(),
                'url'        => $request->fullUrl(),
                'route'      => $request->route()?->getName(),
                'ip'         => $request->ip(),
                'status'     => $response->getStatusCode(),
            ]);
        }

        return $response;
    }
}
