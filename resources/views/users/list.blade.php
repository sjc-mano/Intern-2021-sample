@extends('shared.layout')

@section('title', '在庫管理システム')

@section('style')
@endsection

@section('content')
<div class="dashboard page-list">
    <form method="get" action="{{ route('users.create') }}">
        <button class="sp-fixed--bottom" type="submit">＋</button>
    </form>
    <div class="user">
        <div class="user__search">
            <form id="search_form" action="{{ route('users.list') }}" method="get" autocomplete="off">
                <div class="user__search__flex">
                    <input id="js-search-userid" name="user_id" type="text" class="user__search__userId"
                        placeholder="ユーザID" maxlength="10" value="{{ Request::query('user_id') }}">
                </div>
                <div id="js-error-search-userid" class="edit__format__errorMessage-list"></div>
                <div class="user__search__flex">
                    <input name="user_name" type="text" class="user__search__userName" placeholder="ユーザ名" maxlength="20"
                        value="{{ Request::query('user_name') }}">
                    <button id="js-userlist_search" class="button--oval--search" type="submit">検索</button>
                </div>
            </form>
        </div>
        <table id="users_table" class="user__table">
            <thead>
                <tr class="user__table__tr">
                    <th class="user__table__th"><span>ユーザID</span><span></span></th>
                    <th class="user__table__th"><span>ユーザ名</span><span></span></th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr class="user__table__tr" data-href="{{ route('users.edit', [$user->user_id])  }}">
                    <td class="user__table__td">{{ $user->user_id }}</td>
                    <td class="user__table__td">{{ $user->user_name }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" style="text-align: center">取得したユーザは０件です</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('javascript')
<script>
    $(document).ready(function () {
        // ユーザIDの昇順でソート
        $('#users_table').tablesorter({
            sortList: [[0, 0]]
        });
    });

    // クリックされたユーザの編集画面へ遷移
    $(function($) {
        $("tbody .user__table__tr").css("cursor","pointer").click(function() {
            location.href = $(this).data("href");
        });
    });
</script>
@endsection