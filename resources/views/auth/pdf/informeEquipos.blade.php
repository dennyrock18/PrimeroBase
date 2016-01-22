@extends('layouts/layoutpdf')

@section('content')

    @if(count($equipos)!=0)
        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
            <tr>
                <th class="service">Numero de Serie</th>
                <th class="desc">Modelo</th>
                <th class="desc">Tipo de Equipo</th>
                <th class="desc">Propietario</th>
            </tr>
            </thead>
            <tbody>
            @foreach($equipos as $equipo)
                <tr>
                    <td class="service">{{$equipo->s_n}}</td>
                    <td class="desc">{{$equipo->model}}</td>
                    <td class="desc">{{$equipo->type->tipoequipo}}</td>
                    <td class="desc">{{$equipo->user->fullname}}</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="2"></td>
                <td>Total de Registros:</td>
                <td class="grand total">{{count($equipos)}}</td>
            </tr>
            </tfoot>
        </table>
    @else
        <h3>NO EXISTEN REGISTROS EN EL SISTEMA </h3>
    @endif

@stop

