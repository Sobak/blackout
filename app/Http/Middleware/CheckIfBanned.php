<?php

namespace App\Http\Middleware;

use Closure;

class CheckIfBanned
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
        if (auth()->user()->bana) {
            // fixme...
            die (
            'Vous avez &eacute;t&eacute; bannis. Plus D\'infos <a href="banned.php">ici</a>.'
            );
        }

        return $next($request);
    }
}
