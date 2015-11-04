<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AddUserAdminRequest;
use App\Http\Requests\editUserAdminRequest;
use App\User;
use DOMDocument;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Styde\Html\Facades\Alert;
use GeneaLabs\Phpgmaps\Phpgmaps;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role','admin')->get();
        return view('auth/AdminSistem/users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = state();
        return view('auth.AdminSistem.addUser', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddUserAdminRequest $request)
    {
        if (!is_numeric($request->get('city_id'))) {
            Alert::message('Debe seleccionar un estado y su ciudad', 'danger');
            return redirect()->back();
        }
        $user = new User($request->all());
        $user->role = 'admin';
        $user->save();

        Alert::message('Se ha creado el Nuevo Administrador: ' . $user->fullname, 'success');
        return redirect()->route('admin.administrator.index');
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
        $states = state();

        return view('auth.AdminSistem.editUser', compact('user','states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(editUserAdminRequest $request, $id)
    {
        //dd($request);

        $user = User::find($id);
        $user->fill($request->all());
        $user->save();

        //dd($user);

        Alert::message('It has been updated successfully', 'success');
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
        $message = 'El administrador: ' . $user->fullname . ' fue eliminado de nuestro registro';
        if($request->ajax())
        {
            return response()->json([
                'id' => $user->id,
                'message' => $message
            ]);
        }

        Session::flash('message', $message);
        return redirect()->route('admin.administrator.index');
    }

    public function detailsUser($id)
    {
        $users = User::Find($id);
        $latitudLongitud = $this->latiLongi($users->Direccion);
        $marker = $this->maps($latitudLongitud);
        return view('auth/AdminSistem/detailsUser', compact('users', 'marker'));

    }

    public function latiLongi($direccion)
    {
        $latitud = 0;
        $longitud = 0;
        $doc = new DOMDocument();
        $xml = "http://maps.googleapis.com/maps/api/geocode/xml?address=" . $direccion . "&sensor=true";
        $doc->load($xml);

        $persona = $doc->getElementsByTagName("result");

        foreach ($persona as $p) {
            $latitud = $p->getElementsByTagName("lat");
            $latitud = $latitud->item(0)->nodeValue;

            $longitud = $p->getElementsByTagName("lng");
            $longitud = $longitud->item(0)->nodeValue;

        }

        return $latitudLongitud = array('latitud' => $latitud, 'longitud' => $longitud);
    }

    /**
     * @param $latitudLongitud
     * @return array
     */
    public function maps($latitudLongitud)
    {

        $marker = array();
        $config = array();
        $config['center'] = '' . $latitudLongitud['latitud'] . ',' . $latitudLongitud['longitud'] . '';
        $config['zoom'] = 'auto';
        $config['onboundschanged'] = 'if (!centreGot) {
                    var mapCentre = map.getCenter();
                    marker_0.setOptions({
                        position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng())
                    });
                }
                centreGot = true;';

        $m = new Phpgmaps($config);
        $m->add_marker($marker);
        $map = $m->create_map();
        $marker = array('map_js' => $map['js'], 'map_html' => $map['html']);

        return $marker;

    }
}
