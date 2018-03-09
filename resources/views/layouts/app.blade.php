<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

</head>
<body>

    @section('navbar')
      @include('layouts.navbar')
    @show

    <div id="app">

        <main class="py-4">
            @yield('content')
        </main>
        
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
</body>
</html>
