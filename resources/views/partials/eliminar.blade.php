{!! Form::open(['route' => ['admin.user.destroy', $user], 'method' => 'DELETE']) !!}
<button type="submit" onclick="return confirm('Decea sure to delete the record?')" class="btn btn-danger">Eliminar Usuario</button>
{!! Form::close() !!}