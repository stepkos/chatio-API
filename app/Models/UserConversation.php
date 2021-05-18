<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserConversation extends Pivot
{
    use HasFactory;

    protected $table = 'user_conversations';

    protected $fillable = [
        'member_name'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function conversation() {
        return $this->belongsTo(Conversation::class);
    }

    public function messages() {
        return $this->hasMany(Message::class);
    }
}
