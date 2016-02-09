<?php

namespace App\Models\UrgentNotice;

use Illuminate\Database\Eloquent\Model;

class UrgentNotice extends Model
{
    protected $table = 'urgent_notices';
    protected $fillable = ['banner_id', 'title', 'description', 'attachment_type_id', 'start', 'end'];
}
