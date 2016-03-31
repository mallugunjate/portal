<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class EventValidator extends PortalValidator
{
    protected $rules = [
    	'title' 		=> 'required',
    	'event_type'	=> 'required|integer',
    	'start'			=> 'required|date',
    	'end'			=> 'required|date',
    	'target_stores'	=> 'required'
            
    ];

    protected $messages = [
    	
    ];

}
