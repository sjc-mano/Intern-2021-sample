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
        <table class="user__table">
            <tr class="user__table__tr">
                <th class="user__table__th">ユーザID</th>
                <th class="user__table__th">ユーザ名</th>
            </tr>
            @forelse($users as $user)
            <tr class="user__table__tr" data-href="{{ url('/users/' . $user->user_id . '/edit')  }}">
                <td class="user__table__td">{{ $user->user_id }}</td>
                <td class="user__table__td">{{ $user->user_name }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="2" style="text-align: center">取得したユーザは０件です</td>
            </tr>
            @endforelse
        </table>
    </div>
</div>
@endsection

@section('javascript')
<script>
</script>
@endsection