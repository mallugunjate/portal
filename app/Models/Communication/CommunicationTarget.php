<?php

namespace App\Models\Communication;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use DB; 


class CommunicationTarget extends Model
{
	protected $table = 'communications_target';
	protected $fillable = ['communication_id', 'store_id', 'is_read'];

	public static function getTargetedCommunications($storeNumber)
	{
        $today = Carbon::today()->toDateString();

        $communications = CommunicationTarget::where('communications_target.store_id', '=', $storeNumber)
        				->join('communications', 'communications_target.communication_id', '=', 'communications.id')
                        ->where('communications.send_at' , '<=', $today)
                        ->where('communications.archive_at', '>=', $today)
        				->orderBy('communications.send_at', 'desc')
        				->get();


        CommunicationTarget::prettifyCommunications($communications);
        return $communications;
	}

    public static function getTargetedCommunicationsByCategory($storeNumber, $type_id)
    {
        $today = Carbon::today()->toDateString();

        $communications = CommunicationTarget::where('communications_target.store_id', '=', $storeNumber)
                        ->join('communications', 'communications_target.communication_id', '=', 'communications.id')
                        ->where('communications.send_at' , '<=', $today)
                        ->where('communications.archive_at', '>=', $today)
                        ->where('communications.communication_type_id', '=', $type_id)
                        ->orderBy('communications.send_at', 'desc')
                        ->get();


        CommunicationTarget::prettifyCommunications($communications);
        return $communications;
    }

	public static function prettifyCommunications($communications)
    {
     foreach($communications as $c){
          
        // get the human readable days since send
        $send_at = Carbon::createFromFormat('Y-m-d H:i:s', $c->send_at);
        $since = Carbon::now()->diffForHumans($send_at, true);
        $c->since = $since;

        //make the timestamp on the message a little nicer

        $c->prettyDate = $send_at->format('D j F');
      }
      return $communications;
    }

	public static function markAsRead($id, $store_id)
	{
	    $communication = CommunicationTarget::where('communication_id', $id)
	    				->where('store_id', $store_id)
	    				->first();
	    				
	    $communication->is_read = '1';
	    $communication->save();
	}
}
