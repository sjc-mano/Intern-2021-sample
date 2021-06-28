<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_items', function (Blueprint $table) {
            $table->string('item_id', 25)->comment('品番ID');
            $table->datetime('created_at')->nullable()->comment('作成日時');
            $table->datetime('updated_at')->nullable()->comment('更新日時');
            $table->boolean('delete_flg')->nullable()->default(0)->comment('削除フラグ');

            $table->primary('item_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_items');
    }
}
