<div class="modal fade" id="myModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Calendario
                    <small>{{ $user->fullname }}</small>
                </h4>

            </div>
            <div class="modal-body">
                <center>
                    <div class="input-group date">
                        <input type="text" readonly="readonly" name="fecha{{$user->id}}" id="date{{$user->id}}" class="form-control"
                                ><span
                                class="input-group-addon"><i
                                    class="glyphicon glyphicon-th"></i></span>
                    </div>
                </center>
            </div>

            <div class="modal-footer">
                {!! Form::submit('Close', ['class' => 'btn btn-default', 'data-dismiss'=>'modal']) !!}
                {!! Form::submit('Save', ['class' => 'btn btn-primary ']) !!}

            </div>
        </div>
    </div>
</div>