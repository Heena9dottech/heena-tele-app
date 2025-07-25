<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TelegramMessage extends Model
{
    protected $table = 'telegram_messages';
    protected $fillable = ['chat_id', 'username', 'message'];
}
