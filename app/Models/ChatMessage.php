<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = ['chat_id', 'question', 'response'];

    // Definir la relación con Chat
    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }
}
