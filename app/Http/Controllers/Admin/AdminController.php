<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AddUserRequest;
use App\states;
use App\User;
use D3Catalyst\GeoIP\Laravel4\Facades\GeoIP;
use DOMDocument;
use GeneaLabs\Phpgmaps\Phpgmaps;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Styde\Html\Facades\Alert;

class AdminController extends Controller
{
    public function setting()
    {
        return view('auth/Admin/index');

    }

    public function terminar($id)
    {
        //dd('esta aqui');
        $users = User::Find($id);

        Mail::send('emails/confirm', compact('users'), function ($m) use ($users) {
            $m->to($users->email, $users->name)->subject('Su equipo esta Listo!!!!');
        });

        $users->terminado=1;

        $users->save();

        Alert::message('Se le ha enviado un correo al Usuario: '.$users->fullname, 'success');
        return redirect()->route('admin.user.index');

    }

    public function detailsUser($id)
    {

        $users = User::Find($id);

        $latitudLongitud = $this->latiLongi($users->Direccion);

        $marker = $this->maps($latitudLongitud);


        return view('auth/Admin/detailsUser', compact('users','marker'));

    }

    /**
     * @param $latitudLongitud
     * @return array
     */
    public function maps($latitudLongitud)
    {

        $marker = array();
        $config = array();
        $config['center'] = ''. $latitudLongitud['latitud']. ','.$latitudLongitud['longitud'].'';
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

    public function latiLongi($direccion)
    {
        $latitud = 0;
        $longitud = 0;
        $doc=new DOMDocument();
        $xml="http://maps.googleapis.com/maps/api/geocode/xml?address=".$direccion."&sensor=true";
        $doc->load($xml);

        $persona=$doc->getElementsByTagName("result");

        foreach ($persona as $p)
        {
            $latitud=$p->getElementsByTagName("lat");
            $latitud=$latitud->item(0)->nodeValue;

            $longitud=$p->getElementsByTagName("lng");
            $longitud=$longitud->item(0)->nodeValue;

        }

        return $latitudLongitud = array('latitud' => $latitud, 'longitud' => $longitud);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();

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

        $states = states::lists('state', 'id')->toArray();
        //$states = states::get();

        return view('auth.Admin.addUser', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddUserRequest $request)
    {
        if(!is_numeric($request->get('city_id')))
        {
            Alert::message('Debe seleccionar un estado y su ciudad','danger');
            return redirect()->back();
        }

        $user = new User($request->all());

        $user->password = bcrypt($request->get('password'));
        $user->role = $request->get('role');
        $user->registration_token = str_random(40);
        //dd($user);

        $user->save();

        $url = route('confirmation', ['token' => $user->registration_token]);

        Mail::send('emails/registrations', compact('user', 'url'), function ($m) use ($user) {
            $m->to($user->email, $user->name)->subject('Active your account!');
        });

        Alert::mensage('Se ha creado el Usuario: ' . $user->fullname);
        return redirect()->route('admin.user.index');

    }

    protected function getConfirmation($token)
    {
        $user = User::where('registration_token', $token)->firstOrFail();
        //dd($user);
        $user->registration_token = null;
        $user->save();

        Alert::message('Your email ' . $user->email . ' has been verified.', 'success');
        return redirect()->route('login');
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
        $users = User::Find($id);

        return view('auth.Admin.addUser', compact('users'));
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
