<?php

namespace App\Http\Middleware;

use Closure;

class IsBanUser
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
        $user = $request->user();
        if ($user) {
            if ($user = auth()->user()->is_ban) {
                auth()->logout();
            }
        }
        return $next($request);
    }
}
