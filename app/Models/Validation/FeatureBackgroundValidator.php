<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class FeatureBackgroundValidator extends PortalValidator
{
    protected $rules = [
    	
    	'background' => 'sometimes|mimes:gif,jpeg,jpg,png'
            
    ];

}
