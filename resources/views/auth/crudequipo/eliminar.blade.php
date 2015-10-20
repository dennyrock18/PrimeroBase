{!! Form::open(['route' => ['admin.equipo.destroy', $tipoequipo], 'method' => 'DELETE']) !!}
<button type="submit" onclick="return confirm('Sure to delete the record?')" class="btn btn-danger">Eliminar el Tipo de Equipo</button>
{!! Form::close() !!}