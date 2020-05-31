<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNotifyToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //通知に関する設定を保存できるようにする
            //disabled, push, everyday, everyweekの3種類
            $table->string('notify_posts')->default('push');
            $table->string('notify_users')->default('push');
            $table->string('notify_messages')->default('push');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('notify_posts');
            $table->dropColumn('notify_users');
            $table->dropColumn('notify_messages');
        });
    }
}
