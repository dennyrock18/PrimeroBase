<?php

namespace App\Http\Controllers\Admin;

use App\Equipo;
use App\tipoEquipo;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Styde\Html\Facades\Alert;

class UserEquipoController extends Controller
{

    public static function tipoEquipo()
    {
        return tipoEquipo::lists('tipoequipo', 'id')->toArray();
    }

    public function getquipouser($id)
    {
        $user = User::find($id);
        $tipoEquipo = $this->tipoEquipo();

        //dd($user);
        return view ('auth.userEquipo.addEquipo', compact('user','tipoEquipo'));
    }

    public function postquipouser($id, Request $request)
    {
        $this->validate($request, [
            's_n' => 'required|unique:equipos,s_n',
            'model' => 'required',
            'tipo_equipos_id' => 'required'
        ]);

        $user = User::find($id);

        $equipo = new Equipo($request->all());
        $equipo->user_id = $user->id;

        $equipo->save();

        Alert::message('Se agrego un nuevo equipo', 'success');
        return redirect()->route('admin.add.user.equipos.edit', compact('user'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::get();
        return view('auth/userEquipo/usersEquipo', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view ('auth.userEquipo.equiposXuser', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
