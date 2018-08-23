<?php

namespace App\Http\Middleware;

use Closure;

class LogUserVisit
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
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $user->onlinetime = time();
        $user->user_lastip = $_SERVER['REMOTE_ADDR'];
        $user->user_agent = $_SERVER['HTTP_USER_AGENT'];
        $user->save();

        return $next($request);
    }
}
