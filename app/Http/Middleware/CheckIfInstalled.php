<?php

namespace App\Http\Middleware;

use Closure;

class CheckIfInstalled
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
        if ((file_exists(base_path('.env')) === false || filesize(base_path('.env')) == 0)
            && str_contains($request->path(), 'install') === false) {

            return redirect()->route('install');
        }

        return $next($request);
    }
}
