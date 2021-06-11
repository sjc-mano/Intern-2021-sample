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
     * @param string $user_id
     * @param array  $columns
     * @return Illuminate\Database\Query\Builder $queryBuilder
     */
    public function getById($user_id, $columns)
    {
        $where = [
            ['user_id', $user_id],
            ['delete_flg', config('const.FLAG.OFF')]
        ];

        return $this->get($where, $columns);
    }

    /**
     * user_idとuserpassでユーザデータを取得するためのクエリビルダを生成
     *
     * @param string $user_id
     * @param string $user_pass
     * @param array  $columns
     * @return Illuminate\Database\Query\Builder $queryBuilder
     */
    public function getByIdPass($user_id, $user_pass, $columns)
    {
        $where = [
            ['user_id', $user_id],
            ['user_pass', $user_pass],
            ['delete_flg', config('const.FLAG.OFF')]
        ];

        return $this->get($where, $columns);
    }
}
