<?php

namespace App\Http\Middleware;

use App\Components\SendsResponses;
use Closure;
use Illuminate\Support\Facades\Auth;

class AuthUser
{
    use SendsResponses;

    const ERROR_VALIDATION = 'ERROR_VALIDATION';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure                  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::user()) {
            return $this->error(
                static::ERROR_VALIDATION,
                'You need to be logged in to view your recent orders'
            );
        }
        return $next($request);
    }
}
