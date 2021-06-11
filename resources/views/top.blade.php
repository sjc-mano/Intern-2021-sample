<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>在庫管理システム</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body class="preload">
    <div id="app" class="wrapper">
        <div class="content">
            <h1>トップページ</h1>
            <form id="logout-form" action="{{ route('logout') }}" method="post" autocomplete="off">
                @csrf
                @method('delete')
                <input type="submit" value="ログアウト"></button>
            </form>
        </div>
    </div>
</body>

</html>