<?php

namespace App\Models\Search;

use Illuminate\Database\Eloquent\Model;
use App\Models\Document\Document;

class Search extends Model
{
    public static function searchDocuments($query, $store)
    {
    	dd(Document::where('original_filename', 'LIKE', '%'.$query.'%')->get());	
    }

    public static function searchFolders($query, $store)
    {

    }

    public static function searchCommunication($query, $store)
    {

    }

    public static function searchAlerts($query, $store)
    {

    }
}
