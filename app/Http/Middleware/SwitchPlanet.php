<?php

namespace App\Http\Middleware;

use App\Services\PlanetService;
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
        (new PlanetService())->setCurrent($request);

        return $next($request);
    }
}
