<?php

namespace App\Http\Middleware;

use Closure;
use Styde\Html\Facades\Alert;

class Role
{

    protected $hierarchy = [
        'admin'  => 4,
        'chofer' => 3,
        'edit'   => 2,
        'user'   => 1,
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
        $user = currentUser();

        //dd($this->hierarchy[$role],$role);

        if($this->hierarchy[$user->role]< $this->hierarchy[$role])
        {
            if($user->role == 'chofer')
                abort(401);

           auth()->logout();
            Alert::danger('El usuario no puede acceder a la aplicacion');
            return redirect('/');
        }

        return $next($request);
    }
}
