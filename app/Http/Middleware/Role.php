<?php

namespace App\Http\Middleware;

use Closure;
use Styde\Html\Facades\Alert;

class Role
{

    protected $hierarchy = [
        'admin' => 3,
        'edit'  => 2,
        'user'  => 1
    ];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $user = auth()->user();

        if($this->hierarchy[$user->role]< $this->hierarchy[$role])
        {
           auth()->logout();
            Alert::danger('El usuario no puede acceder a la aplicacion');
            return redirect('/');
        }

        return $next($request);
    }
}
