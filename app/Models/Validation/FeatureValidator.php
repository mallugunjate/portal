<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class FeatureValidator extends PortalValidator
{
    protected $rules = [
    	
        'name' 				=> 'required',
    	'documents'			=> 'sometimes|exists:documents,id',
    	'packages'			=> 'sometimes|exists:packages,id',
    	'remove_documents'	=> 'sometimes|exists:documents,id',
    	'remove_packages'	=> 'sometimes|exists:packages,id',
    	'update_type_id'	=> 'required|exists:feature_latest_update_types,id',
    	'update_frequency'	=> 'required|integer|min:1',
    	'start'				=> 'required|date',
    	'end'				=> 'sometimes|date',
    	'thumbnail'			=> 'sometimes|mimes:gif,jpeg,jpg,png',
    	'background'		=> 'sometimes|mimes:gif,jpeg,jpg,png'
            
    ];

    protected $messages = [
    	'name' 						=> 'Feature name required',
    	'documents.exists'	  		=> 'Invalid documents attached',
    	'packages.exists'			=> 'Invalid packages attached',
    	'remove_documents.exists'	=> 'Invalid value in documents',
    	'remove_packages.exists'	=> 'Invalid value in packages',
        'update_type_id.exists'        => 'Invalid value in Latest Updates'
    ];
}
