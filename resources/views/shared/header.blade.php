<div class="header__sp">
    <form name="form_logout" action="{{ route('logout') }}" method="post">
        @csrf
        @method('delete')
        <div class="flex-vertical">
            <div class="flex">
                <a id="js-headeruserName" class="header__sp__logout__a">{{ Auth::user()->user_name }}</a>
                <div id="tri1" class="triangle1"></div>
                <div id="tri2" class="triangle2" style="display: none;"></div>
            </div>
            <a class="header__sp__logout__second__li__link" href="javascript:document.form_logout.submit()" style="display: none;">ログアウト</a>
        </div>
    </form>
</div>
<nav class="menubar">
    <ul class="menubar__nav__ul">
        <li id="information_li" class="menubar__nav__li">
            <div class="menubar__nav__image"><img src="{{ asset('assets/img/NavibarNotice.svg') }}" alt="" width="30" height="30"></div>
            <a class="menubar__nav__item">
                お知らせ
            </a>
        </li>
        <li id="item_li" class="menubar__nav__li {{ Request::is('items*') ? 'is-curent' : '' }}">
            <div class="menubar__nav__image"><img src="{{ asset('assets/img/NavibarProductnumber.svg') }}" alt="" width="30" height="30"></div>
            <a class="menubar__nav__item">
                品番マスタ
            </a>
        </li>
        <li id="user_li" class="menubar__nav__li {{ Request::is('users*') ? 'is-curent' : '' }}">
            <div class="menubar__nav__image"><img src="{{ asset('assets/img/NavibarUser.svg') }}" alt="" width="30" height="30"></div>
            <a class="menubar__nav__item">
                ユーザ管理
            </a>
        </li>
    </ul>
</nav>
