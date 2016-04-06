<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class PackageValidator extends PortalValidator
{
    protected $rules = [
    	
        'package_screen_name' 	=> 'required',
    	'package_name'			=> 'required',
    	'documents'				=> 'sometimes|exists:documents,id',		
    	'folders'				=> 'sometimes|exists:folder_ids,id,folder_type,folder'
            
    ];

    protected $messages = [
    	'package_screen_name' 	=> 'Package name required',
    	'package_name'        	=> 'Package label required',
    	'documents.exists'	  	=> 'Invalid documents attached',
    	'folders.exists'		=> 'Invalid folders attached'

    ];
}
