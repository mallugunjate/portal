<?php

namespace App\Models\Alert;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $table = 'alerts';

    protected $fillable = ['banner_id', 'document_id', 'alert_type_id'];

    public static function getAllAlerts($banner_id)
    {
    	return Alert::join('documents', 'alerts.document_id' , '=', 'documents.id')
    			->join('alert_types', 'alert_types.id', '=', 'alerts.alert_type_id')
    			->where('alerts.banner_id', $banner_id)->get();
    }

}
