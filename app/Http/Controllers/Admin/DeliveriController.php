<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;

class DeliveriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('fecha_entrega','<>', 'null')->paginate(2);

        return view('auth.Delivery.delivery', compact('users'));
    }

    public function cancelarDelivery($id)
    {
        $user = User::Find($id);

        $user->fecha_entrega = null;
        $user->save();

        return redirect()->route('auth.Delivery.delivery');
    }

    public function fechaEntregaDelivery($id, Request $request)
    {
        $fecha = $request->get('fecha' . $id);

        //Verifico si la fecha existe
        if (!isTrueFecha($id,$fecha)) {
            Alert::message('The date is incorrect', 'danger');
            return redirect()->back();
        }

        //Alert::message('El user paso para el listado de delivery', 'success');
        return redirect()->back();
    }

    public function mapa($id)
    {
        $users = User::Find($id);

        $marker = details($id);

        return view('auth/Delivery/direcionUser', compact('users', 'marker'));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
