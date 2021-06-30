<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Extends this class
 * リポジトリ抽象クラス
 */
abstract class BaseRepository
{
    /**
     * Repository target model.
     *
     * @var object
     */
    protected $model;

    /**
     * This is method in order to store.
     *
     * @param Array  $data
     */
    public function store(Array $data)
    {
        $this->model::create($data);
    }

    /**
     * This is method in order to update.
     *
     * @param Builder $target
     * @param Array  $columns
     * @return int
     */
    public function update(Builder $target, Array $columns)
    {
        return $target->update($columns);
    }

    /**
     * This is method in order to destroy.
     *
     * @param Builder $target
     * @return int
     */
    public function destroy(Builder $target)
    {
        return $target->delete();
    }

    /**
     * 条件に一致するデータを取得するためのクエリビルダを生成
     *
     * @param array $where
     * @param array  $columns
     * @return Builder
     */
    public function get(Array $where, Array $columns = ['*'])
    {
        return $this->model::where($where)
        ->select($columns);
    }
}
