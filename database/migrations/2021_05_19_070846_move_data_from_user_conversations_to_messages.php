<?php

use App\Models\Message;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MoveDataFromUserConversationsToMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::beginTransaction();

        Message::chunk(100, function($messages) {
            foreach($messages as $message) {
                $user_conversation = \DB::table('user_conversations')->find($message->user_conversation_id);
                $message->update(['conversation_id' => $user_conversation->conversation_id]);
            }
        });

        \DB::commit();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
