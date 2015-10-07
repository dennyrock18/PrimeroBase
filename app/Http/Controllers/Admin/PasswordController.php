<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Styde\Html\Facades\Alert;

class PasswordController extends Controller
{
    public function getPassword()
    {
        return view('auth.Admin.password');
    }

    public function postPassword(Request $request)
    {
        $user = auth()->user();

        if (!Hash::check($request->get('current_password'), $user->password)) {
            return redirect()->back()->withErrors([
                'current_password' => 'The current password is not valid'
            ]);
        }
        $this->validate($request, [
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        $user->password = bcrypt($request->get('password'));
        $user->save();

        Alert::message('Su password ha sido cambiado','success');
        return redirect()->route('changePassword');
    }
}
