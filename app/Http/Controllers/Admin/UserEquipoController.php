<?php

namespace App\Http\Controllers\Admin;

use App\Equipo;
use App\pdf;
use App\tipoEquipo;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Styde\Html\Facades\Alert;

class UserEquipoController extends Controller
{

    public function invoice($id)
    {
        $salvar= public_path() . '/storage/';

        $date = date('m-d-Y');
        $name = 'UE-'.auth()->user()->fullname.'-('.$date.').pdf';

        $user = $this->getData($id);
        $invoice = "2222";
        $view =  \View::make('auth.pdf.informeUserEquipos', compact('user', 'date', 'invoice'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        pdfTable($name);

        return $pdf->save($salvar . $name)->stream('informe_User_Equipos('.$date.').pdf');


    }

    public function getData( $id)
    {
        $user =  User::find($id);
        if(is_null($user)|| $user->role == 'admin') abort(404);

        return $user;
    }

    public static function tipoEquipo()
    {
        return tipoEquipo::lists('tipoequipo', 'id')->toArray();
    }

    public function getquipouser($id)
    {
        $user = User::find($id);
        if(is_null($user)|| $user->role == 'admin') abort(404);
        $tipoEquipo = $this->tipoEquipo();

        //dd($user);
        return view ('auth.userEquipo.addEquipo', compact('user','tipoEquipo'));
    }

    public function postquipouser($id, Request $request)
    {
        $this->validate($request, [
            's_n' => 'required|unique:equipos,s_n',
            'model' => 'required',
            'tipo_equipos_id' => 'required|exists:tipo_equipos,id'
        ]);

        $user = User::find($id);
        if(is_null($user)|| $user->role == 'admin') abort(404);

        $equipo = new Equipo($request->all());
        $equipo->terminado = 0;
        $equipo->user_id = $user->id;

        $user->terminado = 0;
        $user->save();

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
        $users= User::where('role','user')->whereNull('fecha_entrega')
            ->get();

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
        if(is_null($user) || $user->role == 'admin') abort(404);

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
