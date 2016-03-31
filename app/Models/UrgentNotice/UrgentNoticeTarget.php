<?php

namespace App\Models\UrgentNotice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UrgentNoticeTarget extends Model
{
	use SoftDeletes;
    protected $table = 'urgent_notice_target';

    protected $fillable = ['urgent_notice_id', 'store_id', 'is_read'];
    protected $dates = ['deleted_at'];
}
