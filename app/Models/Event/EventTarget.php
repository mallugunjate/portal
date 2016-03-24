<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;

class EventTarget extends Model
{
    protected $table = 'events_target';
    protected $fillable = ['event_id', 'store_id'];
}
