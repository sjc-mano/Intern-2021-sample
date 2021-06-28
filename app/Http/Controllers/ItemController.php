<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ItemService;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{
    protected $itemService;

    public function __construct(
        ItemService $itemService
    ) {
        $this->itemService = $itemService;
    }

    /**
     * 品番管理画面を表示
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 検索条件に一致するユーザの取得
        $items = $this->itemService->search($request);

        return view('items.list')->with([
            'items' => $items
        ]);
    }

    /**
     * 品番作成画面を表示
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('items.create');
    }

    /**
     * 品番作成
     *
     * @param \App\Http\Requests\StoreUsersRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsersRequest $request)
    {
        $return = $this->userService->store($request);

        if(array_key_exists('success', $return)){
            return response()->json(['message' => $return['success']], 200);
        }else{
            return response()->json(['message' => $return['error']], 500);
        }
    }

    /**
     * 品番編集画面を表示
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        return view('items.edit');
    }

    /**
     * 品番編集
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
    }

    /**
     * 品番削除
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
    }
}
