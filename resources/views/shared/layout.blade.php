<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
        <title> @yield('title') </title>
        <script src="{{ asset('assets/js/lib/jquery-3.4.1.min.js') }}"></script>
        <script src="{{ asset('assets/js/common.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

        @section('style') @show
    </head>

    <body class="preload">
        <div id="app" class="wrapper">
            <div class="content">
                @include('shared.header')

                @yield('content')

            </div>
        </div>

        @section('javascript') @show
        <script>
            document.getElementById("user_li").onclick = function() {
                window.location.href = "{{ route('users.list') }}";
            };
        </script>
    </body>

    @section('css') @show
</html>
