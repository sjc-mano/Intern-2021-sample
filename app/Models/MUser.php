<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class MUser extends Authenticatable
{
    protected $table = 'm_users';
    
    protected $primaryKey = 'user_id';

    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'user_name',
        'user_pass',
        'mail_address',
        'created_at',
        'updated_at',
        'delete_flg'
    ];
}
