<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_stock', function (Blueprint $table) {
            $table->string('stock_id', 25)->comment('在庫ID');
            $table->integer('stock_num')->comment('在庫数');
            $table->datetime('created_at')->nullable()->comment('作成日時');
            $table->datetime('updated_at')->nullable()->comment('更新日時');
            $table->boolean('delete_flg')->nullable()->default(0)->comment('削除フラグ');

            $table->primary('stock_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('d_stock');
    }
}
