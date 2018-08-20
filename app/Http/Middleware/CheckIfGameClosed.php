<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class CheckIfGameClosed
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
        if (config('blackout.game_close') && auth()->user()->authlevel < User::LEVEL_OPERATOR) {
            return show_message(config('blackout.game_name'), config('blackout.close_reason'));
        }

        return $next($request);
    }
}
