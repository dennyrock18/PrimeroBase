{!! Form::open(['route' => ['admin.admin.destroy', $user], 'method' => 'DELETE']) !!}
<button type="submit" onclick="return confirm('Sure to delete the record?')" class="btn btn-danger">Eliminar el Administrador</button>
{!! Form::close() !!}