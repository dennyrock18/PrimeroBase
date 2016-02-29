<div class="form-group">
    {!! Field::text('s_n',['label' => 'Numero de Serie','required','class'=> 'form-control', 'placeholder' => 'Please, write the serial number']) !!}
</div>
<div class="form-group">
    {!! Field::text('model',['label' => 'Modelo','required','class'=> 'form-control', 'placeholder' => 'Please, write the model']) !!}
</div>
<div class="form-group">
    {!! Field::select('tipo_equipos_id',$tipoEquipo ,['empty' => 'Seleccione...','label' => 'Tipo de Equipo','required','id' => 'state','class' => 'form-control']) !!}

</div>
<div class="form-group">
    {!! Field::textarea('observacion',['label' => 'Observacion','rows' => '3','required','class'=> 'form-control', 'placeholder' => 'Please, write the Observation']) !!}
</div>

<div class="form-group">

    <div class="well">
        <p class="text-center">
            <img src="data:image/png;base64,{{codigoBarra($codigoBarra)}}" height="50"></p>
    </div>

</div>





