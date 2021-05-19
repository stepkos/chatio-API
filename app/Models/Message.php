<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';

    protected $fillable = [
        'conversation_id',
        'user_id',
        'content'
    ];

    protected $casts = [
        'conversation_id' => 'integer',
        'user_id' => 'integer'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function conversation() {
        return $this->belongsTo(Conversation::class);
    }
}
