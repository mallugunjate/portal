<?php

namespace App\Models\UrgentNotice;

use Illuminate\Database\Eloquent\Model;

class UrgentNoticeAttachment extends Model
{
    protected $table = 'urgent_notice_attachment';
    protected $fillable = ['urgent_notice_id' , 'attachment_id'];
}
