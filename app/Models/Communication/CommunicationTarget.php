<?php

namespace App\Models\Communication;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use DB; 
use App\Models\Utility\Utility;


class CommunicationTarget extends Model
{
	protected $table = 'communications_target';
	protected $fillable = ['communication_id', 'store_id', 'is_read'];

	public static function getTargetedCommunications($storeNumber)
	{
        $now = Carbon::now()->toDatetimeString();

        $communications = CommunicationTarget::where('communications_target.store_id', '=', $storeNumber)
        				->join('communications', 'communications_target.communication_id', '=', 'communications.id')
                        ->where('communications.send_at' , '<=', $now)
                        ->where('communications.archive_at', '>=', $now)
        				->orderBy('communications.send_at', 'desc')
        				->get();

        foreach ($communications as $c) {
            $c->prettyDate = Utility::prettifyDate($c->send_at);
            $c->since = Utility::getTimePastSinceDate($c->send_at);
        }
        return $communications;
	}

    public static function getTargetedCommunicationsByCategory($storeNumber, $type_id)
    {
        $now = Carbon::now()->toDatetimeString();

        $communications = CommunicationTarget::where('communications_target.store_id', '=', $storeNumber)
                        ->join('communications', 'communications_target.communication_id', '=', 'communications.id')
                        ->where('communications.send_at' , '<=', $now)
                        ->where('communications.archive_at', '>=', $now)
                        ->where('communications.communication_type_id', '=', $type_id)
                        ->orderBy('communications.send_at', 'desc')
                        ->get();

        foreach ($communications as $c) {
            $c->prettyDate = Utility::prettifyDate($c->send_at);
            $c->since = Utility::getTimePastSinceDate($c->send_at);
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
