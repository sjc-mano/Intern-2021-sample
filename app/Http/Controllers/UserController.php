<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsersRequest;
use Illuminate\Http\Request;
use App\Services\EncryptService;
use App\Services\UserService;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    protected $encryptService;
    protected $userService;

    public function __construct(
        EncryptService $encryptService,
        UserService $userService
    ) {
        $this->encryptService = $encryptService;
        $this->userService = $userService;
    }

    /**
     * ユーザ管理画面を表示
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 検索条件に一致するユーザの取得
        $users = $this->userService->search($request);

        return view('users.list')->with([
            'users' => $users
        ]);
    }

    /**
     * ユーザ作成画面を表示
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('users.create');
    }

    /**
     * ユーザ作成
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
     * ユーザ編集画面を表示
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        return view('users.edit');
    }

    /**
     * ユーザ編集
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
    }

    /**
     * ユーザ削除
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
    }
}
