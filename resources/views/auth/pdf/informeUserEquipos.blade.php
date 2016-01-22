@extends('layouts/layoutpdf')

@section('content')

    <h2>Usuario: {{$user->fullname}}</h2>

    @if(count($user->equipo)!=0)
        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
            <tr>
                <th class="service">Numero de Serie</th>
                <th class="desc">Modelo</th>
                <th class="desc">Tipo de Equipo</th>
                <th class="desc">Terminado</th>
            </tr>
            </thead>
            <tbody>
            @foreach($user->equipo as $userEquipo)
                <tr>
                    <td class="service">{{$userEquipo->s_n}}</td>
                    <td class="desc">{{$userEquipo->model}}</td>
                    <td class="desc">{{$userEquipo->type->tipoequipo}}</td>
                    <td class="desc">
                        @if($userEquipo->terminado != 0)
                            <img src="{{asset('imag/forudaa.png')}}" title="Terminado">
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="2"></td>
                <td>Total de Registros:</td>
                <td class="grand total">{{count($user->equipo)}}</td>
            </tr>
            </tfoot>
        </table>
    @else
        <h3 class=" ">NO EXISTEN REGISTROS EN EL SISTEMA </h3>
    @endif

@stop


