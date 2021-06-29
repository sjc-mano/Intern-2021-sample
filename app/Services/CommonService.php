<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Repositories\ItemRepository;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Log;

class CommonService
{
    private $userRepository;
    private $itemRepository;

    public function __construct(
        UserRepository $userRepository,
        ItemRepository $itemRepository
    ) {
        $this->userRepository = $userRepository;
        $this->itemRepository = $itemRepository;
    }

    /**
     * 編集中に別のユーザが編集していないかの判定
     * 
     * @param string $type
     * @param string $id
     * @param string displayPageTime
     * @return boolean
     */
    public function updatedCheck($type, $id, $displayPageTime)
    {
        $column = ['updated_at'];

        if($type === "User"){
            $updatedAt = $this->userRepository->get([['user_id', $id]], $column)->first()->updated_at;
        }else if($type === "Item"){

        }

        $displayPageTime = new Carbon($displayPageTime);
        $updatedAt = new Carbon($updatedAt);

        if($displayPageTime->gt($updatedAt)){
            return false;
        }else{
            return true;
        }
    }
}
