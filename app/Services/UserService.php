<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Services\EncryptService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
     * @param \Illuminate\Http\Request $request
     * @param string $userPass
     * @return int
     */
    public function login($request)
    {
        $user = $this->userRepository->get(['user_id' => $request['id']])->NotDeleted()->first();

        if($user && $request['password'] === $user->user_pass){
            // ログイン成功
            return 200;
        }
        else{
            // ログイン失敗
            return 404;
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
            ["user_name", "like", (mb_strlen($searchUserName) >= 3 ? "%" : "") . "$searchUserName%"]
        ];
        // 取得カラム指定
        $columns = ['user_id', 'user_name'];

        return $this->userRepository->get($where, $columns)->NotDeleted()->get();
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
            $data = array_filter($request->input());

            $return = $this->userRepository->store([
                'user_id' => $data['user_id'],
                'user_pass' => $data['user_pass'],
                'user_name' => $data['user_name'],
                'mail_address' => $data['mailaddress'] ?? null
            ]);

            DB::commit();
            return ['success' => config('const.MESSAGE.SUCCESS.STORE')];
        } catch (\Throwable $throwable) {
            Log::error($throwable->getFile() . " : line " . $throwable->getLine());
            Log::error('UserService->store ExceptionMessage :\n ' . $throwable->getMessage());
            DB::rollBack();
            return ['error' => config('const.MESSAGE.ERROR.STORE')];
        }
    }

    /**
     * ユーザを更新
     *
     * @param \Illuminate\Http\Request  $request
     * @param string $userId
     * @return array
     */
    public function update($request){
        DB::beginTransaction();
        try {
            $update_data = [
                'user_name' => $request->user_name,
                'mail_address' => $request->mail_address,
            ];

            if($request->user_pass != "●●●●"){
                $update_data['user_pass'] = Hash::make($request->user_pass);
            }

            $user = $this->userRepository->get([['user_id', $request->user_id]]);

            // ユーザマスタの更新
            $this->userRepository->update($user, $update_data);

            DB::commit();
            return ['success' => config('const.MESSAGE.SUCCESS.UPDATE')];
        } catch (\Throwable $throwable) {
            Log::error($throwable->getFile() . " : line " . $throwable->getLine());
            Log::error('UserService->store ExceptionMessage :\n ' . $throwable->getMessage());
            DB::rollBack();
            return ['error' => config('const.MESSAGE.ERROR.STORE')];
        }
    }

    /**
     * ユーザを削除
     *
     * @param \Illuminate\Http\Request  $request
     * @param string $userId
     * @return array
     */
    public function destroy($request)
    {
        DB::beginTransaction();
        try {
            // 処理

            DB::commit();
            return ['success' => config('const.MESSAGE.SUCCESS.DELETE')];
        } catch (\Throwable $throwable) {
            Log::error($throwable->getFile() . " : line " . $throwable->getLine());
            Log::error('UserService->store ExceptionMessage :\n ' . $throwable->getMessage());
            DB::rollBack();
            return ['error' => config('const.MESSAGE.ERROR.STORE')];
        }
    }

    /**
     * ユーザ情報の取得
     *
     * @param string $userId
     * @return model
     */
    public function getUser($userId)
    {
        $where = [['user_id', $userId]];
        $columns = ['*'];
        $user = $this->userRepository->get($where, $columns)->first();

        return $user;
    }
}
