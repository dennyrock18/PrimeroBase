<div class="form-group">
    {!! Field::text('name',['label' => 'Full name','class'=> 'form-control', 'placeholder' => 'Please, write the full name']) !!}
</div>

<div class="form-group">
    {!! Field::text('id_user',['label' => 'Number Id','class'=> 'form-control', 'placeholder' => 'Please, write the number id']) !!}
</div>

<div class="form-group">
    {!! Field::email('email',['label' => 'Email-Address','class'=> 'form-control', 'placeholder' => 'Please, write the email']) !!}
</div>

<div class="form-group">
    {!! Field::text('streetAddress',['label' => 'Street Address','class'=> 'form-control', 'placeholder' => 'Please, write the street address']) !!}
</div>

<div class="form-group">
    {!! Field::text('secundaryAddress',['label' => 'Secundary Address','class'=> 'form-control', 'placeholder' => 'Please, write the secundary address']) !!}
</div>

<div class="form-group">
    {!! Field::text('city',['label' => 'City','class'=> 'form-control', 'placeholder' => 'Please, write the city']) !!}
</div>

<div class="form-group">
    {!! Field::text('postCode',['label' => 'Post Code','class'=> 'form-control', 'placeholder' => 'Please, write the post code']) !!}
</div>

<div class="form-group">
    {!! Field::select('pais_id',$states ,['label' => 'Country','class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Field::text('state',['label' => 'State','class'=> 'form-control', 'placeholder' => 'Please, write the state']) !!}
</div>

<div class="form-group">
    {!! Field::text('phone',['label' => 'Phone','class'=> 'form-control', 'placeholder' => 'Please, write the phone']) !!}
</div>

<div class="form-group">
    {!! Field::password('password',['class'=> 'form-control', 'placeholder' => 'Please, write the password']) !!}
</div>

<div class="form-group">
    {!! Field::password('password_confirmation',['label' => 'Password Confirmation','class'=> 'form-control', 'placeholder' => 'Please, write the password confirmatio']) !!}
</div>

<div class="form-group">
    {!! Field::select('role', trans('role.types'),['class' => 'form-control']) !!}
</div>




