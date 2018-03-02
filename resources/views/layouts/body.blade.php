<!DOCTYPE html>
<html>
<head>

    @section('head')
        @include('layouts.head')
    @show

    @section('css')
        @include('layouts.css')
    @show

</head>
<body>

<header class="row">
    @section('navbar')
        @include('layouts.navbar')
    @show
</header>

<div class="container">

    <div id="main-content" class="row">

            @yield('main-content')

    </div>

</div>

<footer class="row">
    @section('footer')
        @include('layouts.footer')
    @show
</footer>

@section('js')
    @include('layouts.js')
@show

</body>
</html>
