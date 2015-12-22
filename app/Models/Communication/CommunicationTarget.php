<?php

namespace App\Models\Communication;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommunicationTarget extends Model
{
   protected $table = 'communications_target';
   protected $fillable = ['communication_id', 'store_id', 'is_read'];

	public static function markAsRead($id, $store_id)
	{
	    $communication = CommunicationTarget::where('communication_id', $id)
	    				->where('store_id', $store_id)
	    				->first();
	    				
	    $communication->is_read = '1';
	    $communication->save();
	}
}
