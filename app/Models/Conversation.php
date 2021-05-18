<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $table = 'conversations';

    protected $fillable = [
        'name'
    ];

    public function users() {
        return $this->belongsToMany(User::class, 'user_conversations', 'conversation_id', 'user_id')
            ->withPivot('member_name');
    }

}
