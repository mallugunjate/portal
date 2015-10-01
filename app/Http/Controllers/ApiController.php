<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function getFilesInFolder(Request $request)
    {
        return Document::getDocuments($request);
    }

    public function getFileById($fileId)
    {
        return Document::getDocumentById($fileId);  
    }
}
