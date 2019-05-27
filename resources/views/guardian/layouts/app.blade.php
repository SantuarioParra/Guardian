<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
@include('guardian.layouts.header')

<div id="app" class="app-body">
    @include('guardian.layouts.sidebar')
    <main class="main py-3" >
        @yield('content')
    </main>


</div>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
     function descargar(id,id2,minr){
        alert(id);
        alert(id2);
        alert(minr);
        var asd = fetch('./Pedirllave', {method: 'POST',
            body: JSON.stringify({
                id: id
            })
        });
        alert(asd);
    }
    function descargar2(url) {

        var asd = setInterval(descargar21, 10000);
        function descargar21()
        {
            window.location.href = url;
        }
    }
</script>
</body>
</html>