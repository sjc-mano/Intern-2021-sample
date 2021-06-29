<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\ItemRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ItemService
{
    protected $itemRepository;

    public function __construct(
        ItemRepository $itemRepository
    ) {
        $this->itemRepository = $itemRepository;
    }

    /**
     * 品番管理画面の検索
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function search(Request $request)
    {
        // $data = array_filter($request->input());

        // return $this->itemRepository->get($where, $columns)->NotDeleted()->get();
    }

    /**
     * 品番を追加
     *
     * @param \Illuminate\Http\Request  $request
     * @return array
     */
    public function store($request){
        DB::beginTransaction();
        try {
            $data = array_filter($request->input());

            $return = $this->itemRepository->store([
            ]);

            DB::commit();
            return ['success' => config('const.MESSAGE.SUCCESS.STORE')];
        } catch (\Throwable $throwable) {
            Log::error($throwable->getFile() . " : line " . $throwable->getLine());
            Log::error('ItemService->store ExceptionMessage :\n ' . $throwable->getMessage());
            DB::rollBack();
            return ['error' => config('const.MESSAGE.ERROR.STORE')];
        }
    }

    /**
     * 品番を更新
     *
     * @param \Illuminate\Http\Request  $request
     * @param string $itemId
     * @return array
     */
    public function update($request){
        DB::beginTransaction();
        try {
            // 処理

            DB::commit();
            return ['success' => config('const.MESSAGE.SUCCESS.UPDATE')];
        } catch (\Throwable $throwable) {
            Log::error($throwable->getFile() . " : line " . $throwable->getLine());
            Log::error('ItemService->store ExceptionMessage :\n ' . $throwable->getMessage());
            DB::rollBack();
            return ['error' => config('const.MESSAGE.ERROR.STORE')];
        }
    }

    /**
     * 品番を削除
     *
     * @param \Illuminate\Http\Request  $request
     * @param string $itemId
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
            Log::error('ItemService->store ExceptionMessage :\n ' . $throwable->getMessage());
            DB::rollBack();
            return ['error' => config('const.MESSAGE.ERROR.STORE')];
        }
    }
}
