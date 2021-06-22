<?php

namespace App\Repositories;

use App\Models\MUser;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository
{
    public function __construct(MUser $users)
    {
        $this->model = $users;
    }

    /**
     * user_idでユーザデータを取得するためのクエリビルダを生成
     *
     * @param string $userId
     * @param array  $columns
     * @return Illuminate\Database\Query\Builder $queryBuilder
     */
    public function getById($userId, $columns)
    {
        $where = [
            ['user_id', $userId],
            ['delete_flg', config('const.FLAG.OFF')]
        ];

        return $this->get($where, $columns);
    }

    /**
     * user_idとuserpassでユーザデータを取得するためのクエリビルダを生成
     *
     * @param string $userId
     * @param string $userPass
     * @param array  $columns
     * @return Illuminate\Database\Query\Builder $queryBuilder
     */
    public function getByIdPass($userId, $userPass, $columns)
    {
        $where = [
            ['user_id', $userId],
            ['user_pass', $userPass],
            ['delete_flg', config('const.FLAG.OFF')]
        ];

        return $this->get($where, $columns);
    }
}
