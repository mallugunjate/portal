<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;

class FolderValidator extends PortalValidator
{
    protected $rules = [ 
    		
    		'name' 		=> 'required',
    		'parent'	=> 'sometimes|exists:folder_ids,id'

     ];

     protected $messages = [
     	'name.required'   => 'Folder Name cannot be empty',
     	'parent.exists'	  => 'Parent Folder not valid' 	

     ];
}
