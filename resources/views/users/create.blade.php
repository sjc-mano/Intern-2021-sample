@extends('shared.layout')

@section('title', '在庫管理システム')

@section('style')
@endsection

@section('content')

<div class="dashboard page-list">
    <div class="subnavi">
        <div class="subnavi__flex">
            <div>
                <a id="back_button"><img src="{{ asset('assets/img/BackBt.svg') }}" alt="" width="80" height="90"></a>
            </div>
            <div class="subnavi__vertical">
            </div>
        </div>
    </div>
    <form id="update-form" action="{{ route('users.store') }}" method="post" autocomplete="off">
        @csrf
        <button id="js-usersave" class="sp-fixed--bottom" type="button" style="display: none;">保存</button>
        <div class="useredit">
            <div class="user__format">
                <div>
                    <div class="user__format__title">ユーザID</div>
                </div>
                <div>
                    <input id="js-userid" class="user__format__input" name="user_id" type="text" value="{{ old('user_id') }}" maxlength="10">
                </div>
                <div id="js-error-userid" class="edit__format__errorMessage">{{ session('user_exists') ?? "" }}</div>
            </div>
            <div class="user__format">
                <div>
                    <div class="user__format__title">パスワード</div>
                </div>
                <div>
                    <input id="js-userpassword" class="user__format__input" name="user_pass" type="text" value="{{ old('user_pass') }}" maxlength="10">
                </div>
                <div id="js-error-userpassword" class="edit__format__errorMessage"></div>
            </div>
            <div class="user__format">
                <div>
                    <div class="user__format__title">ユーザ名</div>
                </div>
                <div>
                    <input id="js-username" class="user__format__input" name="user_name" type="text" value="{{ old('user_name') }}" maxlength="20">
                </div>
                <div id="js-error-username" class="edit__format__errorMessage"></div>
            </div>
            <div class="user__format">
                <div>
                    <div class="user__format__title">メールアドレス</div>
                </div>
                <div>
                    <input id="js-mailaddress" class="user__format__input" name="mail_address" type="text" value="{{ old('mail_address') }}" maxlength="50">
                </div>
                <div id="js-error-mailaddress" class="edit__format__errorMessage"></div>
            </div>
        </div>
    </form>
</div>

@endsection

@section('javascript')

<script>
    const loginUserId = "{{ Auth::id() }}";
    const submitUrl = "{{ route('users.store') }}";
    const editUrl = "{{ route('users.edit', ['user_id' => '@']) }}";
    // 戻るボタン
    $('#back_button').on('click', function() {
        window.location.href = "{{ route('users.list') }}";
    });
</script>

@endsection