<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class dependeLlamada
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $resultado = explode('/',$request->route()->uri());
        $user = User::find($request->route()->parameter($role));

        //dd($request->route());

        if(!is_null($request->route()->parameter($role)) && is_null($user))abort(404);
        if(!is_null($user) && $user->role!=$role && in_array($role,$resultado)) {
            abort(401);
        }
        return $next($request);
    }
}
