<!DOCTYPE html>
<html lang="en">

<head>

    @include('partials.header')

    @yield('header')

</head>

<body>

<div id="wrapper">

    @include('partials.menu')

</div>

@yield('content')

@include('partials.script')

@yield('scripts')

</body>

</html>
