<?php

namespace App\Http\Controllers\Admin;

use App\delivery;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class DeliveriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = new DateTime();

        $users = User::where('fecha_entrega', $today->format('Y-m-d'))->where('role', 'user')->where('activo', '1')->paginate(2);
        $usersAplasados = User::where('fecha_entrega', '<', $today->format('Y-m-d'))->where('role', 'user')->where('activo', '1')->get();

        foreach ($usersAplasados as $user) {
            $user = $this->AplazarDelivery($user->id);
        }

        //dd($today);

        return view('auth.Delivery.delivery', compact('users'));
    }

    public function AplazarDelivery($id)
    {
        $user = User::Find($id);
        $user->fecha_entrega = null;
        $user->save();

        return $user;

    }

    public function cancelarDelivery($id)
    {

        $user = $this->AplazarDelivery($id);

        \Log::alert('El administrador ' . currentUser()->fullname . ' cancelo el delivery para el user ' . $user->fullname);
        return redirect()->route('auth.Delivery.delivery');
    }

    public function fechaEntregaDelivery($id, Request $request)
    {
        $fecha = $request->get('fecha' . $id);

        //Verifico si la fecha existe
        if (!isTrueFecha($id, $fecha)) {
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
        $user = User::find($request->get('id'));
        //dd($user);

        $delivery = new delivery();
        $delivery->user_id = $user->id;
        $delivery->chofer_id = currentUser()->id;

        $user->activo = 0;
        $user->fecha_entrega = null;
        $user->terminado = 0;
        $user->save();
        $delivery->save();

        Alert::message('Se ha realizado el delivery para el user: ' . $user->fullname, 'success');
        return redirect()->route('delivery.index');
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

    public function deliveryR()
    {
        if (currentUser()->role == 'admin')
            $usersDeivery = delivery::get();
        else
            $usersDeivery = delivery::where('chofer_id', currentUser()->id)->get();

        return view('auth.Delivery.deliveryR', compact('usersDeivery'));
    }
}
