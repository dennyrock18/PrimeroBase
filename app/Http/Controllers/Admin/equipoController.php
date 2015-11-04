<?php

namespace App\Http\Controllers\Admin;

use App\Equipo;
use App\tipoEquipo;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Styde\Html\Facades\Alert;

class equipoController extends Controller
{

    public static function tipoEquipo()
    {
        return tipoEquipo::lists('tipoequipo', 'id')->toArray();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipos = Equipo::get();
        //dd($equipos[0]->type);

        return view('auth.equipo.equipos', compact('equipos'));
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
        $equipo = Equipo::find($id);
        $tipoEquipo = $this->tipoEquipo();

        return view ('auth.userEquipo.editEquipo', compact('equipo', 'tipoEquipo'));
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
        $this->validate($request, [
            's_n' => 'required|unique:equipos,s_n,'. $request->route()->parameter('equipo'),
            'model' => 'required',
            'tipo_equipos_id' => 'required'
        ]);
        $equipo = Equipo::find($id);
        $equipo->fill($request->all());
        $equipo->save();

        Alert::message('El equipo a sido actualisado', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $equipo= Equipo::find($id);
        $equipo->delete();
        $message = 'El equipo: ' . $equipo->s_n . ' del user '.$equipo->user->fullname .' fue eliminado de nuestro registro';
        if($request->ajax())
        {
            return response()->json([
                'id' => $equipo->id,
                'message' => $message
            ]);
        }

        Session::flash('message', $message);
        return redirect()->route('admin.add.user.equipos.edit');
    }
}
