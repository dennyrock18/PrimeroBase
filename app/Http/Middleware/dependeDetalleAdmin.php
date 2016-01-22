<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class dependeDetalleAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $current = auth()->user();

        if(is_null($request->route()->parameter($role)) && $current->email!='admin@demo.com')abort(401);

        $user = User::find($request->route()->parameter($role));

        if(is_null($user)&& !is_null($request->route()->parameter($role)) )abort(404);
        if($current->email!='admin@demo.com' && $user->email != $current->email ) abort(401);

        return $next($request);
    }
}
