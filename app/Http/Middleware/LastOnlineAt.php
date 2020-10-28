<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LastOnlineAt
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->guest()) {
            return $next($request);
        }

        if (is_null(auth()->user()->last_online_at) || auth()->user()->last_online_at->diffInMinutes(now()) > 15) {
            DB::table('users')
                ->where('id', auth()->user()->id)
                ->update(['last_online_at' => now()]);
        }

        return $next($request);
    }
}
