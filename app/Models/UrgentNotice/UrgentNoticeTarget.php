<?php

namespace App\Models\UrgentNotice;

use Illuminate\Database\Eloquent\Model;

class UrgentNoticeTarget extends Model
{
    protected $table = 'urgent_notice_target';

    protected $fillable = ['urgent_notice_id', 'store_id', 'is_read'];
}
