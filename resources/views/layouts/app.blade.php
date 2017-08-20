<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Music Archives') }}</title>

        <!-- Styles -->
        <link href="{{ asset('lib/bootstrap-4.0.0-beta-dist/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"></link>
        <link href="{{ asset('lib/bootstrap-datetimepicker-4.17.47/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css"></link>

        @yield('styles')

        <!-- Scripts -->
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>
    </head>
    <body>
        <div class="container">
            @yield('topNav')

            <h1>Hello</h1>
            @yield('content')
        </div>


        <script src="{{ asset('lib/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('lib/popper.js-1.12.3/popper.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('lib/moment-2.18.1.js') }}" type="text/javascript"></script>
        <script src="{{ asset('lib/bootstrap-4.0.0-beta-dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('lib/bootstrap-datetimepicker-4.17.47/bootstrap-datetimepicker.js') }}" type="text/javascript"></script>

        @yield('scripts')

        <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker();
            });
        </script>
    </body>
</html>
