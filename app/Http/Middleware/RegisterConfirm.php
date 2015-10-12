<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Styde\Html\Facades\Alert;

class RegisterConfirm
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
        $token = $request->route()->parameters('token');

        $users = User::get();

        foreach ($users as $user)
        {
            $aux = ['token' => $user->registration_token];

            if ($aux == $token)
            {
                return $next($request);
            }
        }

        Alert::message('The token has been verified', 'danger');
        return redirect()->route('home');
    }
}
