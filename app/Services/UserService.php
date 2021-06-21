<?php

namespace App\Services;

use Illuminate\Http\Request;
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
     * @param string $userId
     * @param string $userPass
     * @return int
     */
    public function login($userId, $userPass)
    {
        $user = $this->userRepository->getByIdPass($userId, $userPass, ['user_id'])->first();

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
     * ユーザ管理画面の検索
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function search(Request $request)
    {
        $data = array_filter($request->input());
        $searchUserId = $data['user_id'] ?? "";
        $searchUserName = $data['user_name'] ?? "";

        // 検索条件指定(3文字以下→前方一致、３文字以上→部分一致)
        $where = [
            ["user_id", "like", (mb_strlen($searchUserId) >= 3 ? "%" : "") . "$searchUserId%"],
            ["user_name", "like", (mb_strlen($searchUserName) >= 3 ? "%" : "") . "$searchUserName%"],
            ["delete_flg", config("const.FLAG.OFF")]
        ];
        // 取得カラム指定
        $columns = ['user_id', 'user_name'];

        return $this->userRepository->get($where, $columns)->get();
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
     * @param string $userId
     * @return array
     */
    public function update($request, $userId){
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
     * @param string $userId
     * @return array
     */
    public function destroy($request, $userId)
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
