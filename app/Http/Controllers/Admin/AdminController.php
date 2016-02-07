<?php

namespace App\Http\Controllers\Admin;

use App\Equipo;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\editUserRequest;
use App\User;
use Faker\Factory as Faker;
use Faker\Generator;
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
        $chofer = User::where('role','chofer')->get();
        $admins = User::where('role','admin')->get();
        $users = User::where('role','user')->get();
        $equipos = Equipo::get();

        return view('auth/Admin/index', compact('chofer', 'admins', 'users','equipos'));
    }

    public function detailsUser($id)
    {
        $users = User::Find($id);
        //if(is_null($users)|| $users->role == 'admin') abort(404);

        $marker = details($id);

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

        $faker = Faker::create();

        $user = new User($request->all());
        $user->role = 'user';
        $user->registration_token = str_random(40);
        $user->terminado = 0;
        $user->fecha_entrega = null;
        $user->activo = 1;
        $user->codigo_barra = $faker->isbn10;
        $user->save();

        $url = route('confirmation', ['token' => $user->registration_token]);

        Mail::send('emails/registrations', compact('user', 'url'), function ($m) use ($user) {
            $m->to($user->email, $user->name)->subject('Active your account!');
        });

        Alert::message('Se ha creado el Usuario: ' . $user->fullname, 'success');
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
        return redirect()->route('admin.users.index');
    }

    public function fechaEntrega($id, Request $request)
    {
        $fecha = $request->get('fecha' . $id);

        //Verifico si la fecha existe
        if (!isTrueFecha($id,$fecha)) {
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
