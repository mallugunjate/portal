<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\FolderStructure;
use App\Document;

class ApiController extends Controller
{
     public function getNavigation(Request $request)
    {
        $banner_id = $request->get('banner_id');
        if (isset($banner_id)) {
            
        }
        return FolderStructure::getNavigationStructure();

    }

    public function getDocumentsInFolder(Request $request)
    {
        return Document::getDocuments($request);
    }

    public function getDocumentById($fileId)
    {
        return Document::getDocumentById($fileId);  
    }
}
