<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class CheckUserLevel
 *
 * A pre-request middleware to check if user level is equal or above the
 * minimal access level required to visit the route. MUST be called after
 * auth.
 */
class CheckUserLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int  Minimal level to access the page
     * @return mixed
     */
    public function handle($request, Closure $next, $minimalLevel)
    {
        if (auth()->user()->authlevel < $minimalLevel) {
            abort(403);
        }

        return $next($request);
    }
}
