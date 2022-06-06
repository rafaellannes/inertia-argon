<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <!-- Styles -->


    <!-- Scripts -->
    @routes

    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/css/nucleo-icons.css">
    <link rel="stylesheet" href="/css/nucleo-svg.css">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link id="pagestyle" rel="stylesheet" href="/css/argon-bootstrap.css">

</head>

<body class="g-sidenav-show bg-gray-100">

    @inertia

    @env('local')
    {{-- <script src="http://localhost:3000/browser-sync/browser-sync-client.js"></script> --}}
    @endenv

</body>

<script src="{{ mix('js/app.js') }}" defer></script>

<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<script async src="https://buttons.github.io/buttons.js"></script>
{{-- <script type="application/javascript" src="{{ asset('/js/argon/core/popper.min.js') }}" defer></script> --}}
<script type="application/javascript" src="{{ asset('/js/argon/core/bootstrap.min.js') }}"></script>
<script type="application/javascript" src="{{ asset('/js/argon/argon-dashboard.js?v=2.0.2') }}" defer></script>
<script type="application/javascript" src="{{ asset('/js/argon/plugins/perfect-scrollbar.min.js') }}"></script>
<script type="application/javascript" src="{{ asset('/js/argon/plugins/smooth-scrollbar.min.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</html>
