<?php

namespace App\Http\Controllers\Admin;

use App\Equipo;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\editUserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Styde\Html\Facades\Alert;

class AdminController extends Controller
{
    public function eliminarVarios(Request $request)
    {
        dd($request->all());
    }

    public function setting()
    {
        $choferTotal = User::where('role', 'chofer')->count();
        $adminsTotal = User::where('role', 'admin')->count();
        $usersTotal = User::where('role', 'user')->count();
        $equiposTotal = Equipo::count();

        return view('auth/Admin/index', compact('choferTotal', 'adminsTotal', 'usersTotal', 'equiposTotal'));
    }

    public function detailsUser($id)
    {
        $users = User::Find($id);

        $marker = details($id);

        \Log::alert('El administrador ' . currentUser()->fullname . ' consulto el detalle del usuario ' . ' [' . $users->fullname . ']');
        return view('auth/Admin/detailsUser', compact('users', 'marker'));

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role', 'user')->whereNull('fecha_entrega')->where('activo', '1')->get();

        \Log::alert('El administrador ' . currentUser()->fullname . ' consulto el listado de usuarios');
        return view('auth/Admin/users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //$GeoIP = GeoIP::getCountry();
        $states = state();

        \Log::alert('El administrador ' . currentUser()->fullname . ' consulto la paguina para crear un usuario');
        return view('auth.Admin.addUser', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddUserRequest $request)
    {
        if (!is_numeric($request->get('city_id'))) {
            Alert::message('Debe seleccionar un estado y su ciudad', 'danger');
            return redirect()->back();
        }

        $user = new User($request->all());
        $user->role = 'user';
        $user->registration_token = str_random(40);
        $user->terminado = 0;
        $user->fecha_entrega = null;
        $user->activo = 1;
        $user->codigo_barra = VerificarCodigoBarra();

        $user->save();

        $url = route('confirmation', ['token' => $user->registration_token]);

        Mail::send('emails/registrations', compact('user', 'url'), function ($m) use ($user) {
            $m->to($user->email, $user->name)->subject('Active your account!');
        });

        Alert::message('Se ha creado el Usuario: ' . $user->fullname, 'success');

        \Log::alert('El administrador ' . currentUser()->fullname . ' Creo el usuario ' . ' [' . $user->fullname . ']');
        return redirect()->route('admin.user.index');

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
        $user = User::find($id);
        //if(is_null($user)|| $user->role == 'admin') abort(404);

        \Log::alert('El administrador ' . currentUser()->fullname . ' consulto la paguina para editar al usuario ' . ' [' . $user->fullname . ']');
        return view('auth.Admin.editUser', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(editUserRequest $request, $id)
    {
        $user = User::find($id);
        //if(is_null($user)|| $user->role == 'admin') abort(404);
        $user->role = $request->get('role');
        $user->fill($request->all());
        $user->save();

        Alert::message('It has been updated successfully', 'success');
        \Log::alert('El administrador ' . currentUser()->fullname . ' actualizo los datos de  ' . ' [' . $user->fullname . ']');
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
        $user = User::find($id);
        //if(is_null($user)|| $user->role == 'admin') abort(404);
        $user->delete();
        $message = 'El usuario: ' . $user->fullname . ' fue eliminado de nuestro registro';
        if ($request->ajax()) {
            return response()->json([
                'id' => $user->id,
                'message' => $message
            ]);
        }

        Session::flash('message', $message);
        \Log::alert('El administrador ' . currentUser()->fullname . ' elimino al usuario ' . ' [' . $user->fullname . ']');
        return redirect()->route('admin.users.index');
    }

    public function fechaEntrega($id, Request $request)
    {
        $fecha = $request->get('fecha' . $id);

        //Verifico si la fecha existe
        if (!isTrueFecha($id, $fecha)) {
            Alert::message('The date is incorrect', 'danger');
            return redirect()->back();
        }

        Alert::message('El user paso para el listado de delivery', 'success');
        return redirect()->back();
    }

    protected function getConfirmation($token)
    {
        $user = User::where('registration_token', $token)->firstOrFail();
        $user->registration_token = null;
        $user->save();

        Alert::message('Your email ' . $user->email . ' has been verified.', 'success');
        return redirect()->route('login');
    }
}
