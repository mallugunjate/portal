<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class EventTypeValidator extends PortalValidator
{
	protected $rules = [ 'event_type' => 'required' ];

	protected $messages = [
			'eventType' => 'Event type cannot be empty'
	];    
}
