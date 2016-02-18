<?php

namespace App\Models\UrgentNotice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Communication\Communication;
use DB;
use Carbon\Carbon;


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

    public static function updateUrgentNotice($request, $id)
    {
    	$urgentNotice = UrgentNotice::find($id);
        $attachment_type_id = $urgentNotice->attachment_type_id;


        $banner_id = $request->banner_id;
    	$title = $request->title;
    	$description = $request->description;
    	$start = $request->start;
    	$end = $request->end;	
    	$new_attachments = $request->new_attachments;
        $remove_attachments = $request->remove_attachments;
    	$target_stores = $request->target_stores;
        
        
        $new_attachment_type_id = intval($request->new_attachment_type);
        
        if ($new_attachment_type_id != $attachment_type_id) {
            $attachment_type_id = $new_attachment_type_id;
            UrgentNoticeAttachment::where('urgent_notice_id', $id)->delete();
        }
        else{
            if(isset($remove_attachments)) {
                foreach ($remove_attachments as $attachment) {
                UrgentNoticeAttachment::where('urgent_notice_id', $id)->where('attachment_id', $attachment)->delete();
                } 
            }
            
        } 
        
    	
    	$urgentNotice->update([
    		'banner_id' => $banner_id,
    		'title'		=> $title,
    		'description' => $description,
    		'start'		=> $start,
    		'end'		=> $end,
    		'attachment_type_id'	=> $attachment_type_id
    	]);
    	$urgentNotice->save();

    	
    	if (isset($new_attachments)) {
            foreach ($new_attachments as $attachment) {
            UrgentNoticeAttachment::create([
                'urgent_notice_id' => $urgentNotice->id,
                'attachment_id' => $attachment
            ]);
        }
        }
        
        if (isset($request['target_stores']) && $request['target_stores'] != '' ) {
            UrgentNoticeTarget::where('urgent_notice_id', $id)->delete();
            foreach ($target_stores as $store) {
                UrgentNoticeTarget::create([
                    'urgent_notice_id'  => $urgentNotice->id,
                    'store_id'          => $store
                ]);
            }
        }
    	
        return $urgentNotice;

    }

    public static function deleteUrgentNotice($id)
    {
        UrgentNotice::find($id)->delete();
    }

    public static function getUrgentNoticeCount($storeNumber)
    {
        return UrgentNoticeTarget::where('store_id', $storeNumber)
                                ->where('is_read', 0)
                                ->count();
    }


    public static function getUrgentNoticesByStore($storeNumber)
    {
         $notices = DB::table('urgent_notice_target')->where('store_id', $storeNumber)
                            ->join('urgent_notices', 'urgent_notices.id', '=', 'urgent_notice_target.urgent_notice_id')
                            ->get();

         foreach($notices as $n){
            $updated_at = new Carbon($n->updated_at);

            $since = Carbon::now()->diffForHumans($updated_at, true);
            $n->since = $since;
            $n->prettyDate = $updated_at->toDayDateTimeString();
            $preview_string = strip_tags($n->description);
            $n->trunc = Communication::truncateHtml($preview_string);
         }
         return $notices;        

    }


}
