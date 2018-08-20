<?php

namespace App\Http\Middleware;

use App\Services\Planet;
use Closure;

class SwitchPlanet
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
        (new Planet())->setCurrent($request);

        return $next($request);
    }
}
