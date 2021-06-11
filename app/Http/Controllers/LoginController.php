<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Services\EncryptService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
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

    // ログイン画面を表示
    public function create(Request $request)
    {
        if(Auth::check()){
            return redirect('top');
        }

        return view('login');
    }

    //　ログイン認証
    public function store(LoginRequest $request)
    {
        $encrypt_pass = $this->encryptService->encrypt($request->input('password'));
        $login = $this->userService->login($request->input('id'), $encrypt_pass);

        if($login == 200){
            // ログイン成功
            Log::debug($request->input('id'));
            Auth::loginUsingId($request->input('id'));

            return redirect()->route('home');
        }else{
            // 失敗
            throw ValidationException::withMessages([
                'id' => ["ユーザIDまたは\nパスワードが一致しません"],
            ]);
        }
    }

    // ログアウト
    public function destroy(Request $request)
    {

        if (Auth::check()) {
            Auth::logout();
        }
        return redirect()->route('login.show');

    }

    // トップページを表示
    public function top(Request $request)
    {
        return view('top');
    }
}
