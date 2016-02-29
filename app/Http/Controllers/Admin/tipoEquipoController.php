<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\tipoEquipo;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class tipoEquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoequipo = tipoEquipo::get();
        return view('auth.crudtipoequipo.listequipo', compact('tipoequipo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.crudtipoequipo.addequipo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());

        $this->validate($request, [

            'tipoequipo' => 'required|unique:tipo_equipos,tipoequipo'
        ]);

        $tipoEquipo = new tipoEquipo($request->all());
        $tipoEquipo->save();

        Alert::message('Se agrego un nuevo Tipo de equipo', 'success');
        return redirect()->route('admin.tipoequipo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoequipo = tipoEquipo::find($id);
        if(is_null($tipoequipo)) abort(404);

        return view('auth.crudtipoequipo.editEquipo', compact('tipoequipo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'tipoequipo' => 'required|unique:tipo_equipos,tipoequipo'
        ]);

        $tipoEquipo = tipoEquipo::find($id);
        if(is_null($tipoEquipo)) abort(404);
        $tipoEquipo->fill($request->all());
        $tipoEquipo->save();

        Alert::message('Se a modificado el valor', 'success');
        return redirect()->back();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $tipoequipo= tipoEquipo::find($id);
        if(is_null($tipoequipo)) abort(404);
        $tipoequipo->delete();
        $message = 'El tipo de equipo: ' . $tipoequipo->tipoequipo . ' fue eliminado de nuestro registro';
        if($request->ajax())
        {
            return response()->json([
                'id' => $tipoequipo->id,
                'message' => $message
            ]);
        }

        //Alert::message($message, 'success');
        Session::flash('message', $message);
        return redirect()->route('admin.tipoequipo.index');
    }
}
