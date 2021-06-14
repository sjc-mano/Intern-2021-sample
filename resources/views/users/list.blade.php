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
                    <input id="js-search-userid" type="text" class="user__search__userId" placeholder="ユーザID"
                        maxlength="10">
                </div>
                <div id="js-error-search-userid" class="edit__format__errorMessage-list"></div>
                <div class="user__search__flex">
                    <input type="text" class="user__search__userName" placeholder="ユーザ名" maxlength="20">
                    <button id="js-userlist_search" class="button--oval--search" type="submit">検索</button>
                </div>
            </form>
        </div>
        <table class="user__table">
            <tr class="user__table__tr">
                <th class="user__table__th">ユーザID</th>
                <th class="user__table__th">ユーザ名</th>
            </tr>
            <tr class="user__table__tr">
                <td class="user__table__td">001</td>
                <td class="user__table__td">sample1</td>
            </tr>
            <tr class="user__table__tr">
                <td class="user__table__td">002</td>
                <td class="user__table__td">sample2</td>
            </tr>
            <tr class="user__table__tr">
                <td class="user__table__td">003</td>
                <td class="user__table__td">sample3</td>
            </tr>
            <tr class="user__table__tr">
                <td class="user__table__td">004</td>
                <td class="user__table__td">sample4</td>
            </tr>
        </table>
    </div>
</div>
@endsection

@section('javascript')
<script>
</script>
@endsection