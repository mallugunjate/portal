<?php

namespace App\Models\UrgentNotice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UrgentNotice extends Model
{
    protected $table = 'urgent_notices';
    protected $fillable = ['banner_id', 'title', 'description', 'attachment_type_id', 'start', 'end'];

    public static function storeUrgentNotice(Request $request)
    {
    	
    	$banner_id = $request->banner_id;
    	$title = $request->title;
    	$description = $request->description;
    	$start = $request->start;
    	$end = $request->end;
    	$attachment_type_id = $request->attachment_type;
    	$attachments = $request->attachments;
    	$target_stores = $request->target_stores;
    	
    	\Log::info($request->all());
    	
    	$urgentNotice = UrgentNotice::create([
    		'banner_id' => $banner_id,
    		'title'		=> $title,
    		'description' => $description,
    		'start'		=> $start,
    		'end'		=> $end,
    		'attachment_type_id'	=>$attachment_type_id
    	]);

    	foreach ($attachments as $attachment) {
    		UrgentNoticeAttachment::create([
    			'urgent_notice_id' => $urgentNotice->id,
    			'attachment_id' => $attachment
    		]);
    	}

    	foreach ($target_stores as $store) {
    		UrgentNoticeTarget::create([
    			'urgent_notice_id' 	=> $urgentNotice->id,
    			'store_id'			=> $store
    		]);
    	}
    	return $urgentNotice;
    	
    }
}
