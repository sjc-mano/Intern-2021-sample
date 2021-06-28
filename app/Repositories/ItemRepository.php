<?php

namespace App\Repositories;

use App\Models\MItem;
use Illuminate\Support\Facades\DB;

class ItemRepository extends BaseRepository
{
    public function __construct(MItem $items)
    {
        $this->model = $items;
    }
}
