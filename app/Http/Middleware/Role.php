<?php

namespace App\Http\Middleware;

use Closure;
use Styde\Html\Facades\Alert;

class Role
{

    protected $hierarchy = [
        'admin' => 4,
        'chofer' => 3,
        'edit' => 2,
        'user' => 1,
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $user = currentUser();

        //dd($this->hierarchy[$role],$role);

        if ($this->hierarchy[$user->role] < $this->hierarchy[$role]) {
            if ($user->role == 'chofer') {
                \Log::alert('El chofer ' . $user->fullname . ' intento acceder a una parte que no tiene permiso' . ' [' . $request->route()->uri() . ']');
                abort(401);
            }

            \Log::alert('El usuario ' . $user->fullname . ' intento acceder a la aplicacion' . ' [' . $request->route()->uri() . ']');
            auth()->logout();
            Alert::danger('El usuario no puede acceder a la aplicacion');

            $user->conectado = 0;
            $user->save();
            return redirect('/');
        }

        return $next($request);
    }
}
