{!! Form::open(['route' => ['admin.chofer.destroy', $equipo], 'method' => 'DELETE']) !!}
<button type="submit" onclick="return confirm('Sure to delete the record?')" class="btn btn-danger">Eliminar el Chofer</button>
{!! Form::close() !!}