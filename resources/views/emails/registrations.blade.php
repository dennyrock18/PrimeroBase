<p class="text-center">
    <img src="{{ asset('/imag/Logo.jpg') }}">
</p>

<p>
    Hola <strong>{{ $user->fullname }}</strong>,
    <br>
    <br>
    Usted acaba de registrarce en nuestra compañia para darle solución a sus equipos.
    <br>
    Por esta via le informaremos todo lo relacionado con los equipos que traiga a nuestra empresa, pero al igual
    <br>
    usted puede comunicarce con nosotros a traves de los siguientes datos.

    <br>
    <br>
    Teléfono:(305) 319-0148
    <br>
    Email: mail:solucinformaticas1@gmail.com
    <br>
    <br>
    <br>
    Gracias
    <br>
    <br>
    <br>
    <br>
    <br>
</p>

<footer>
    <hr>
    Enviado por: <strong>{{auth()->user()->fullname}}</strong>
</footer>