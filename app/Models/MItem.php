<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MItem extends Model
{
    protected $table = 'm_items';

    public $primaryKey = 'item_id';

    public $incrementing = false;

    protected $fillable = [
        'item_id',
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
}
