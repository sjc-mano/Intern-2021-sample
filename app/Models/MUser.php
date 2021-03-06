<?php

namespace App\Models;

use App\Services\EncryptService;
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

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // 削除フラグのスコープ（削除されていないものを取得）
    public function scopeNotDeleted($query)
    {
        return $query->where('delete_flg', 0);
    }

    /**
     * パスワード複合
     *
     * @return string
     */
    public function getUserPassAttribute($value)
    {
        $encryptService = new EncryptService();
        return $encryptService->decrypt($value);
    }

    /**
     * パスワード暗号化
     *
     * @param  string  $value
     * @return void
     */
    public function setUserPassAttribute($value)
    {
        $encryptService = new EncryptService();
        $this->attributes['user_pass'] = $encryptService->encrypt($value);
    }
}
