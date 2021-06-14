<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_users', function (Blueprint $table) {
            // 大文字小文字を区別するために'utf8mb4_bin'を指定
            $table->collation = 'utf8mb4_bin';

            $table->string('user_id', 10)->comment('ユーザID');
            $table->string('user_name', 20)->nullable()->comment('ユーザ名');
            $table->string('user_pass', 32)->comment('パスワード');
            $table->string('mail_address', 50)->nullable()->comment('メールアドレス');
            $table->datetime('created_at')->nullable()->comment('作成日時');
            $table->datetime('updated_at')->nullable()->comment('更新日時');
            $table->boolean('delete_flg')->nullable()->default(0)->comment('削除フラグ');

            $table->primary('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_users');
    }
}
