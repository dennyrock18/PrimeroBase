{!! Form::open(['route' => ['admin.equipo.destroy', $equipo], 'method' => 'DELETE']) !!}
<button type="submit" onclick="return confirm('Sure to delete the record?')" class="btn btn-danger">Eliminar el Equipo</button>
{!! Form::close() !!}