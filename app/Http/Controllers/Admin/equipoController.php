<?php

namespace App\Http\Controllers\Admin;

use App\Equipo;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\tipoEquipo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Styde\Html\Facades\Alert;

class equipoController extends Controller
{

    public function invoice()
    {
        $salvar = public_path() . '/storage/';

        $date = date('m-d-Y');
        $name = 'SE-' . str_replace(' ', '-', auth()->user()->fullname) . '-' . $date . '.pdf';

        $equipos = $this->getData();

        $invoice = "2222";
        $view = \View::make('auth.pdf.informeEquipos', compact('equipos', 'date', 'invoice'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        pdfTable($name);

        return $pdf->save($salvar . $name)->stream('informe_de_Equipos(' . $date . ').pdf');
    }

    public function getData()
    {
        $equipos = Equipo::get();

        return $equipos;
    }

    public function terminar($id)
    {
        $equipo = Equipo::Find($id);
        if (is_null($equipo)) abort(404);
        $equipo->terminado = 1;
        $equipo->save();

        $users = User::Find($equipo->user_id);
        $contar = 0;
        foreach ($users->equipo as $equi) {
            if ($equi->terminado == 1) {
                $contar++;
            }
        }

        if (count($users->equipo) == $contar) {

            $users->terminado = 1;

            //return view('emails.confirm', compact('users'));

            Mail::send('emails/confirm', compact('users'), function ($m) use ($users) {
                $m->to($users->email, $users->name)->subject('Su equipo esta Listo!!!!');
            });

            $users->save();
            Alert::message('Se le ha enviado un correo al Usuario: ' . $users->fullname, 'success');
            return redirect()->route('admin.user.index');
        }

        return redirect()->back();

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
        $equipo = Equipo::find($id);
        if (is_null($equipo)) abort(404);
        $tipoEquipo = $this->tipoEquipo();
        $codigoBarra = $equipo->codigo;

        return view('auth.userEquipo.editEquipo', compact('equipo', 'tipoEquipo','codigoBarra'));
    }

    public static function tipoEquipo()
    {
        return tipoEquipo::lists('tipoequipo', 'id')->toArray();
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
            's_n' => 'required|unique:equipos,s_n,' . $request->route()->parameter('equipo'),
            'model' => 'required',
            'tipo_equipos_id' => 'required|exists:tipo_equipos,id',
            'observacion' => 'required|max:100'
        ]);
        $equipo = Equipo::find($id);
        if (is_null($equipo)) abort(404);
        $equipo->fill($request->all());
        $equipo->save();

        Alert::message('El equipo a sido actualisado', 'success');
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
        $equipo = Equipo::find($id);
        if (is_null($equipo)) abort(404);

        $user = $equipo->user;

        //dd($user);
        $equipo->delete();

        if(count($user->equipo)==0)
        {
            $user->terminado = 0;
            $user->save();
        }


        $message = 'El equipo: ' . $equipo->s_n . ' del user ' . $equipo->user->fullname . ' fue eliminado de nuestro registro';
        if ($request->ajax()) {
            return response()->json([
                'id' => $equipo->id,
                'message' => $message
            ]);
        }

        Session::flash('message', $message);
        return redirect()->route('admin.add.user.equipos.edit');
    }
}
