<?php

namespace App\Http\Middleware;

use Closure;

class IsBackoffice
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        if ($user->type != 'backoffice'){
            abort(403);
        }
        return $next($request);
    }
}
