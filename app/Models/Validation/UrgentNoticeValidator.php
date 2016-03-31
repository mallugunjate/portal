<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class UrgentNoticeValidator extends PortalValidator
{
     protected $rules = [
    	
        'title' 		=> 'required',
    	'start'			=> 'required|date',
    	'end'			=> 'required|date',
    	'target_stores'	=> "required_without:allStores",
    	'allStores'     => 'in:on'
            
    ];

    protected $messages = [
        'target_stores.required_without' => 'Target Store missing',
        'allStores.in' => 'Invalid value in Target Stores'
    ];
}
