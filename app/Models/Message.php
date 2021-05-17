<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';

    protected $fillable = [
        'content'
    ];

    public function user_conversations() {
        // return $this->belongsTo();
        /**
         * @todo sprawdzic jak sie dodaje relacje na tabele krzyzowa
         */
    }
}
