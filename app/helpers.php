<?php

use App\states;
use App\User;
use GeneaLabs\Phpgmaps\Phpgmaps;


function currentUser()
{
    return auth()->user();
}

function isNotAdmin($role)
{
    return $role != 'admin';
}

function state()
{
    return states::lists('state', 'id')->toArray();
}

 function details($id)
{

    $users = User::Find($id);
    $latitudLongitud = latiLongi($users->Direccion);
    $marker = maps($latitudLongitud);

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



