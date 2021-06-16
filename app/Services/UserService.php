<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Services\EncryptService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserService
{
    protected $userRepository;
    protected $encryptService;

    public function __construct(
        UserRepository $userRepository,
        EncryptService $encryptService
    ) {
        $this->userRepository = $userRepository;
        $this->encryptService = $encryptService;
    }

    /**
     * ログイン判定
     *
     * @param string $user_id
     * @param string $user_pass
     * @return int
     */
    public function login($user_id, $user_pass)
    {
        $user = $this->userRepository->getByIdPass($user_id, $user_pass, ['user_id'])->first();

        if(is_null($user)){
            // ログイン失敗
            return 404;
        }
        else{
            // ログイン成功
            return 200;
        }
    }

    /**
     * ユーザを追加
     *
     * @param \Illuminate\Http\Request  $request
     * @return array
     */
    public function store($request){
        DB::beginTransaction();
        try {
            // 処理

            DB::commit();
            return ['success' => config('const.SUCCESS_MESSAGE.STORE')];
        } catch (\Throwable $throwable) {
            Log::error($throwable->getFile() . " : line " . $throwable->getLine());
            Log::error('UserService->store ExceptionMessage = ' . $throwable->getMessage());
        } finally {
            DB::rollBack();
            return ['error' => config('const.ERROR_MESSAGE.STORE')];
        }
    }

    /**
     * ユーザを更新
     *
     * @param \Illuminate\Http\Request  $request
     * @param string $user_id
     * @return array
     */
    public function update($request, $user_id){
        DB::beginTransaction();
        try {
            // 処理

            DB::commit();
            return ['success' => config('const.SUCCESS_MESSAGE.UPDATE')];
        } catch (\Throwable $throwable) {
            Log::error($throwable->getFile() . " : line " . $throwable->getLine());
            Log::error('UserService->store ExceptionMessage = ' . $throwable->getMessage());
        } finally {
            DB::rollBack();
            return ['error' => config('const.ERROR_MESSAGE.STORE')];
        }
    }

    /**
     * ユーザを削除
     *
     * @param \Illuminate\Http\Request  $request
     * @param string $user_id
     * @return array
     */
    public function destroy($request, $user_id)
    {
        DB::beginTransaction();
        try {
            // 処理

            DB::commit();
            return ['success' => config('const.SUCCESS_MESSAGE.DELETE')];
        } catch (\Throwable $throwable) {
            Log::error($throwable->getFile() . " : line " . $throwable->getLine());
            Log::error('UserService->store ExceptionMessage = ' . $throwable->getMessage());
        } finally {
            DB::rollBack();
            return ['error' => config('const.ERROR_MESSAGE.STORE')];
        }
    }
}
