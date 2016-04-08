<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AddChoferRequest;
use App\Http\Requests\editChoferRequest;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class ChoferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role','chofer')->get();
        \Log::alert('El administrador ' . currentUser()->fullname . ' visito el listado de los choferes ');
        return view('auth/Chofer/listChofer', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = state();
        \Log::alert('El administrador ' . currentUser()->fullname . ' visito la paguina para crear un chofer ');
        return view('auth.Chofer.addChofer', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddChoferRequest $request)
    {
        dd($request->all());

        if (!is_numeric($request->get('city_id'))) {
            Alert::message('Debe seleccionar un estado y su ciudad', 'danger');
            return redirect()->back();
        }
        $user = new User($request->all());
        $user->role = 'chofer';
        $user->foto = 'avatar.jpg';
        $user->save();

        Alert::message('Se ha creado el Nuevo Chofer: ' . $user->fullname, 'success');
        \Log::alert('El administrador ' . currentUser()->fullname . ' creo el chofer ' . $user->fullname);
        return redirect()->route('admin.chofer.index');
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

        \Log::alert('El administrador ' . currentUser()->fullname . ' visito la paguina para modificar el chofer ' . $user->fullname);
        return view('auth.chofer.editChofer', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(editChoferRequest $request, $id)
    {
        $user = User::find($id);

        $user->fill($request->all());
        $user->save();

        //dd($user);

        Alert::message('It has been updated successfully', 'success');
        \Log::alert('El administrador ' . currentUser()->fullname . ' modifico los datos del chofer ' . $user->fullname);
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
        $user = User::find($id);

        $user->delete();
        $message = 'El chofer: ' . $user->fullname . ' fue eliminado de nuestro registro';
        if ($request->ajax()) {
            return response()->json([
                'id' => $user->id,
                'message' => $message
            ]);
        }

        Session::flash('message', $message);
        \Log::alert('El administrador ' . currentUser()->fullname . ' elimino al chofer ' . $user->fullname);
        return redirect()->route('admin.chofer.index');
    }

    public function detailsChofer($id)
    {
        //
        $users = User::Find($id);

        if(is_null($users)) abort(404);
        $marker = details($id);

        \Log::alert('El administrador ' . currentUser()->fullname . ' consulto el detalle del chofer ' . $users->fullname);
        return view('auth/Chofer/detailsChofer', compact('users','marker'));

    }
}
