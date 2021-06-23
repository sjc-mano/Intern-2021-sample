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
}
