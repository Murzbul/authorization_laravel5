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

@if( Session::get('username') == 'anonymous' )
  @section('navbar')
      @include('layouts.navbar_logout')
  @show
@else
  @section('navbar')
      @include('layouts.navbar')
  @show
@endif

<div class="container-fluid mt-5">
    <div id="main-content">
            @yield('main-content')
    </div>
</div>

@section('footer')
    @include('layouts.footer')
@show

@section('js')
    @include('layouts.js')
@show

</body>
</html>
