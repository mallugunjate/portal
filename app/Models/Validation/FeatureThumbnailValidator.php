<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class FeatureThumbnailValidator extends PortalValidator
{
     protected $rules = [
    	
    	'thumbnail'			=> 'sometimes|mimes:gif,jpeg,jpg,png'
            
    ];
}
