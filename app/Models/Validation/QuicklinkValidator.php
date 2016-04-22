<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class QuicklinkValidator extends PortalValidator
{
    protected $rules = [

    	'banner_id'		=> 'required|exists:banners,id',
    	'link_name'		=> 'required',
    	'type'			=> 'required|exists:quicklinks_types,id',
    	'folder_url'	=>'sometimes|exists:folder_ids,id',
    	'document_url'	=> 'sometimes|exists:documents,id',
    	'external_url'	=> 'sometimes|url'

    ];

}
