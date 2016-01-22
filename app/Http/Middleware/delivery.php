<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class delivery
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
        $user = User::find($request->route()->parameter('user'));

        if($user->role != 'user') abort(401);

        return $next($request);
    }
}
