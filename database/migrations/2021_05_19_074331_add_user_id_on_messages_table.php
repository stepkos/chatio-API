<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdOnMessagesTable extends Migration
{
    
    public function up()
    {
        Schema::table('messages', function(Blueprint $table) {
            $table->foreignId('user_id')->constrained()->after('id');
        });
    }

    public function down()
    {
        Schema::table('messages', function(Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('messages', function(Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
