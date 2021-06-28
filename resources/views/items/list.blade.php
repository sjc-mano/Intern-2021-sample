@extends('shared.layout')

@section('title', '在庫管理システム')

@section('style')
@endsection

@section('content')

<div class="dashboard page-list">
    <form method="get" action="{{ route('items.create') }}">
        <button class="sp-fixed--bottom" type="submit">＋</button>
    </form>
    <div class="item">
        <div class="item__search">
            <form id="search_form" action="{{ route('items.list') }}" method="get" autocomplete="off">
                <div class="item__search__itemnum">
                    <input id="js-search-itemnumber" type="text" name="item_id" class="item__search__itemNumber category_items" placeholder="品番"
                        value="{{ Request::query('item_id') }}" maxlength="25">
                    <div id="js-error-search-itemnumber" class="edit__format__errorMessage-list"></div>
                </div>
                <div class="item__search__flex">
                    <div id="search_arrow1" class="{{ Request::query('item_category_code')=="" ? "searcharrow_item" : "" }} category_items">
                        <select id="select_engineeringCatetegory" name="item_category_code" class="item__search__engineeringCatetegory category_items">
                            <option value=""></option>
                            @forelse($engineering_categories as $key => $value)
                            <option value="{{ $key }}"
                                {{ Request::query('item_category_code')==$key ? "selected" : "" }}>{{ $value }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div id="search_arrow2" class="{{ Request::query('pur_company_code')=="" ? "searcharrow_item2" : "" }} category_purchased" style="display: none;">
                        <select name="pur_company_code" class="item__search__company category_purchased" style="display: none;">
                            <option value=""></option>
                            @forelse($pur_companies as $key => $value)
                            <option value="{{ $key }}" {{ Request::query('pur_company_code')==$key ? "selected" : "" }}>{{ $value }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div id="search_arrow3" class="{{ Request::query('material_company_code')=="" ? "searcharrow_item3" : "" }} category_materials" style="display: none;">
                        <select name="material_company_code" class="item__search__materialsMaker category_materials" style="display: none;">
                            <option value=""></option>
                            @forelse($material_companies as $key => $value)
                            <option value="{{ $key }}" {{ Request::query('material_company_code')==$key ? "selected" : "" }}>{{ $value }}
                            </option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div>
                        <button id="itemslist_search1" class="button--oval--search category_items" type="button">検索</button>
                        <button id="itemslist_search2" class="button--oval--search category_purchased" type="button" style="display: none;">検索</button>
                        <button id="itemslist_search3" class="button--oval--search category_materials" type="button" style="display: none;">検索</button>
                    </div>
                </div>
                <div class="item__search__flex item__search__margin">
                    <div class="item__search__alerttitle">
                        アラート対象
                    </div>
                    <input class="item__search__alert" type="checkbox" name="alert_flg" {{ Request::query('alert_flg') ? "checked" : "" }}>
                </div>
            </form>
        </div>
        <table id="items_table" class="item__list">
            @if (Request::query('category') == 0)
            <thead>
                <tr class="item__list__tr">
                    <th class="item__list__th"><span>品番</span><span></span></th>
                    <th class="item__list__th"><span>工程種別</span><span></span></th>
                    <th class="stock__list__th"><span>在庫</span><span></span></th>
                    <th class="is-right"><span><img class="information__th__imagealert" src="{{ asset('assets/img/Alert.svg') }}"></span><span></span></th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                <tr class="item__list__tr" data-href="{{ url('/items/' . str_replace('/', '@', $item->item_id) . '/edit')  }}">
                    <td class="item__list__td">{{ $item->item_id }}</td>
                    <td class="item__list__td">{{ $item->item_category_code == "A05" ? "-" : $engineering_categories[$item->item_category_code] }}</td>
                    <td class="stock__list__td is-right">{{ $item->stock_num }}</td>
                    <td class="information__alerttable__image is-right">
                        @if ($item->alert_flg == 1)
                        <div hidden>{{ $item->alert_update_at }}</div>
                        <img class="information__alerttable__imagealert" src="{{ asset('assets/img/Alert.svg') }}">
                        @else
                        <div hidden>2000-01-01 00:00:00</div>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align: center">取得した品番は０件です</td>
                </tr>
                @endforelse
            @elseif (Request::query('category') == 1)
                <thead>
                    <tr class="item__list__tr">
                        <th class="item__list__th"><span>購入品品番</span><span></span></th>
                        <th class="item__list__th"><span>客先</span><span></span></th>
                        <th class="stock__list__th"><span>在庫</span><span></span></th>
                        <th class="is-right"><span><img class="information__th__imagealert" src="{{ asset('assets/img/Alert.svg') }}"></span><span></span></th>
                    </tr>
                </thead>
            <tbody>
                @forelse($items as $item)
                <tr class="item__list__tr" data-href="{{ url('/purchased/' . str_replace('/', '@', $item->pur_item_id) . '/edit')  }}">
                    <td class="item__list__td">{{ $item->pur_item_id }}</td>
                    <td class="item__list__td-maker">{{ $item->pur_company_code != "99" ? $pur_companies[$item->pur_company_code] : $item->pur_company_name }}</td>
                    <td class="stock__list__td is-right">{{ $item->stock_num }}</td>
                    <td class="information__alerttable__image is-right">
                        @if ($item->alert_flg == 1)
                        <div hidden>{{ substr($item->alert_update_at, 0, 16) }}</div>
                        <img class="information__alerttable__imagealert" src="{{ asset('assets/img/Alert.svg') }}">
                        @else
                        <div hidden>2000-01-01 00:00:00</div>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align: center">取得した購入品番は０件です</td>
                </tr>
                @endforelse
            @else
                <thead>
                    <tr class="item__list__tr">
                        <th class="item__list__th"><span>材料品番</span><span></span></th>
                        <th class="item__list__th"><span>メーカー</span><span></span></th>
                        <th class="stock__list__th"><span>在庫</span><span></span></th>
                        <th class="is-right"><span><img class="information__th__imagealert" src="{{ asset('assets/img/Alert.svg') }}"></span><span></span></th>
                    </tr>
                </thead>
            <tbody>
                @forelse($items as $item)
                <tr class="item__list__tr" data-href="{{ url('/materials/' . str_replace('/', '@', $item->material_id) . '/edit')  }}">
                    <td class="item__list__td">{{ $item->material_id }}</td>
                    <td class="item__list__td-maker">{{ $item->material_company_code != "99" ?
                        $material_companies[$item->material_company_code] : $item->material_company_name }}</td>
                        <td class="stock__list__td is-right">{{ $item->stock_num }}</td>
                        <td class="information__alerttable__image is-right">
                            @if ($item->alert_flg == 1)
                            <div hidden>{{ $item->alert_update_at }}</div>
                            <img class="information__alerttable__imagealert" src="{{ asset('assets/img/Alert.svg') }}">
                            @else
                            <div hidden>2000-01-01 00:00:00</div>
                            @endif
                        </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align: center">取得した材料品番は０件です</td>
                </tr>
                @endforelse
                @endif
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('javascript')

<script>
    var selectvalue_blade = ""
    // tableSorterの適用
    $(document).ready(function () {
        $('#items_table').tablesorter({
            sortList: [[0, 0]]
        });
    });

    $(window).on('load',function(){
        if(location.search.slice(1) == "0"){
            // 削除完了アラート表示
            alert("品番の削除が完了しました。");
            window.location.href = "{{ route('items.list') }}";
        }else if(location.search.slice(1) == "1"){
            // 編集する品番が既に削除されているアラート表示
            alert("編集する品番は既に削除されています。");
            window.location.href = "{{ route('items.list') }}";
        }
    });

    // 選択されている種別の作成画面へ遷移
    document.getElementById("item_create_button").onclick = function () {
        category = $('#search_category').val()

        if (category == "0") {
            window.location.href = "{{ route('items.create') }}";
        } else if (category == "1") {
            window.location.href = "{{ route('purchased.create') }}";
        } else {
            window.location.href = "{{ route('materials.create') }}";
        }
    };

    // 種別の選択肢の指定
    window.onload = function () {
        $('#search_category').val('{{ app("request")->input("category") ? app("request")->input("category") : 0 }}');
        categoryChange();
    };

    // 
    $('#search_category').change(function () {
        categoryChange();
        $('.category_items').val('');
        $('.category_purchased').val('');
        $('.category_materials').val('');
    });

    // 種別が切り替えられた時、検索条件の表示の切り替え
    function categoryChange() {
        if ($('#search_category').val() == '0') {
            $('.category_items').show().prop("disabled", false);
            $('.category_purchased').not('.category_items').hide().prop("disabled", true);
            $('.category_materials').not('.category_items').hide().prop("disabled", true);

        } else if ($('#search_category').val() == '1') {
            $('.category_items').not('.category_purchased').hide().prop("disabled", true);
            $('.category_purchased').show().prop("disabled", false);
            $('.category_materials').not('.category_purchased').hide().prop("disabled", true);
        } else {
            $('.category_items').not('.category_materials').hide().prop("disabled", true);
            $('.category_purchased').not('.category_materials').hide().prop("disabled", true);
            $('.category_materials').show().prop("disabled", false);
        }
    }

    // クリックされた品番の編集画面へ遷移
    $(function ($) {
        $("tbody .item__list__tr").css("cursor", "pointer").click(function () {
            location.href = $(this).data("href");
        });
    });
</script>

@endsection

@section('css')
    <style type="text/css">
        .information__th__imagealert{width:15px;height:15px}

        .searcharrow_item {
            position: relative;
            display: inline-block;
        }
        .searcharrow_item::after {
            content: "工程種別";
            display: block;
            /* width: 0;
            height: 0; */
            position: absolute;
            top: 32%;
            right: 150px;
            margin-top: -5px;
            color: #999;
        }

        .searcharrow_item2 {
            position: relative;
            display: inline-block;
        }
        .searcharrow_item2::after {
            content: "客先";
            display: block;
            /* width: 0;
            height: 0; */
            position: absolute;
            top: 30%;
            right: 180px;
            margin-top: -5px;
            color: #999;
        }

        .searcharrow_item3 {
            position: relative;
            display: inline-block;
        }
        .searcharrow_item3::after {
            content: "材料メーカー";
            display: block;
            /* width: 0;
            height: 0; */
            position: absolute;
            top: 30%;
            right: 120px;
            margin-top: -5px;
            color: #999;
        }
    </style>
@endsection