<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class FormErrorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        /** @var \Illuminate\Http\Response $response */
        $response = $next($request);

        if ($response->exception instanceof ValidationException) {
            error("Please correct the validation errors");
        }

        return $response;
    }
}
