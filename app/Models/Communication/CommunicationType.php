<?php

namespace App\Models\Communication;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommunicationType extends Model
{
	use SoftDeletes;
    protected $table = 'communication_types';
    protected $dates = ['deleted_at'];
    protected $fillable = ['communication_type', 'banner_id', 'colour'];

    public static function getCommunicationTypeCount($storeNumber, $storeBanner)
    {
    	$communicationTypes = CommunicationType::where('banner_id', $storeBanner)->get();
    	foreach($communicationTypes as $ct){
            $ct->count = Communication::getActiveCommunicationCountByCategory($storeNumber, $ct->id);
        }
        return $communicationTypes;	
    }

    public static function getCommunicationTypeCountAllMessages($storeNumber, $storeBanner)
    {
        $communicationTypes = CommunicationType::where('banner_id', $storeBanner)->get();
         foreach($communicationTypes as $ct){
            $ct->count = Communication::getAllCommunicationCountByCategory($storeNumber, $ct->id);
        }
        return $communicationTypes; 
    }    
}
