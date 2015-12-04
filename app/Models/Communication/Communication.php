<?php

namespace App\Models\Communication;

use Illuminate\Database\Eloquent\Model;

class Communication extends Model
{
    protected $table = 'communications';
    protected $fillables = ['subject', 'body', 'sender', 'importance', 'send_at', 'archive_at', 'is_draft'];
}
