<?php

use App\citys;
use App\pdf;
use App\states;
use App\User;
use Carbon\Carbon;
use GeneaLabs\Phpgmaps\Phpgmaps;


function currentUser()
{
    return auth()->user();
}


function cambiarFecha($fecha)
{
    $resultado = explode('-',$fecha);

    return $resultado[1] . '/' . $resultado[2] . '/' . $resultado[0];
}

function diasEntreFechas($fecha){

    $fecha_f = new DateTime();
    $fecha_i = new DateTime($fecha);

    $dias	= (strtotime($fecha_i->format('Y-m-d'))-strtotime($fecha_f->format('Y-m-d')))/86400;
    $dias 	= abs($dias); $dias = floor($dias);

    if($dias==0)
        return 'Hoy';
    if($dias==1)
        return 'Ayer';

    return 'Hace ' . $dias . ' dias';
}

function  haceCuantos($fecha)
{

    $today = new DateTime();
    $creado = new DateTime($fecha);

    $fechaInicio = explode('-',$creado->format('Y-m-d'));
    $fechaFinal  = explode('-',$today->format('Y-m-d'));
    $ini = mktime(0,0,0,$fechaInicio[0], $fechaInicio[1], $fechaInicio[2]);
    $fin = mktime(0,0,0,$fechaFinal[0],$fechaFinal[1],$fechaFinal[2]);
    $x = (floor(($fin - $ini)/60/60/24));
    //dd('Dias entre las fechas dadas: '.$x);

    return 'Dias entre las fechas dadas:'.$x;
}
    /*$date = Carbon::yesterday();

    if($date == $fecha)
        return 'Yesterday';
    if($date == $fecha)
        return 'Yesterday';*/



function NoAceptadoCorreo()
{
    $user = User::where('registration_token','<>','null')->where('role','user')->get();

    return $user;
}

function pdfTable($name)
{
    $pdfgenerar = new pdf();
    $pdfgenerar->name = $name;
    $pdfgenerar->user_id = auth()->user()->id;

    //dd($pdf);
    $pdfgenerar->save();
}

function isTrueFecha($id,$fecha)
{
    $user = User::find($id);
    $resultado = explode('/',$fecha);

    //Verifico si la fecha existe
    if (!checkdate($resultado[0], $resultado[1], $resultado[2])) {
        return false;
    }

    $today = new DateTime();
    $date = new DateTime($fecha);

    //Verifico si la fecha es mayor que la del dia en que se esta
    if($date < $today)
    {
        //dd($date);
        return false;
    }

    //dd($today, $date);
    $user->fecha_entrega = $date;
    $user->save();

    return true;

}

function isNotAdmin($role)
{
    return $role != 'admin';
}

function state()
{
    return states::lists('state', 'id')->toArray();
}

function city($value)
{
    return citys::where('state_id',$value)->lists('city', 'id')->toArray();
}

function fecha($value)
{
    $date = Carbon::now();

    $date = $value;

    return $date->toFormattedDateString();
}

function hora($value)
{
    $date = Carbon::now();

    $date = $value;

    return $date->toTimeString();
}

 function details($id)
{
    $users = User::Find($id);
    //dd($users);
    $latitudLongitud = latiLongi($users->Direccion);
    $marker = maps($latitudLongitud);

     //dd($marker);

    return $marker;

}

 function latiLongi($direccion)
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
 function maps($latitudLongitud)
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



