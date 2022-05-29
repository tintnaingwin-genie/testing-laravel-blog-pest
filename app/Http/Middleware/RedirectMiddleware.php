<?php

namespace App\Http\Middleware;

use App\Models\Redirect;
use Closure;
use Illuminate\Http\Request;

class RedirectMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $path = parse_url($request->fullUrl())['path'] ?? '/';

        $redirect = Redirect::where('from', $path)->first();

        if (! $redirect) {
            return $next($request);
        }

        return response()->redirectTo($redirect->to);
    }
}
