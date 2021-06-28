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
    @if (Request::is('users/create*') || Request::is('users/*/edit*'))
    <script src="{{ asset('assets/js/usersedit.js') }}"></script>
    @endif
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.1/js/jquery.tablesorter.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.1/js/extras/jquery.metadata.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/tablesorter.css') }}">

    @section('style') @show
</head>

<body class="preload">
    <div id="app" class="wrapper">
        <div class="content">
            @include('shared.header')

            @yield('content')

        </div>
    </div>
    <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>

    @section('javascript') @show
    <script>
        document.getElementById("user_li").onclick = function () {
            window.location.href = "{{ route('users.list') }}";
        };
        document.getElementById("item_li").onclick = function () {
            window.location.href = "{{ route('items.list') }}";
        };
    </script>
</body>

@section('css') @show
</html>