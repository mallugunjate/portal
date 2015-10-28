<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\FolderStructure;
use App\Document;
use App\Folder;
use App\Week;

class ApiController extends Controller
{
     public function getNavigation($id)
    {
        $banner_id = $id;
        return FolderStructure::getNavigationStructure($banner_id);

    }

    public function getDocumentsInFolder($id, $isWeek)
    {
        $folder_id = $id;
        
        $isweek = $isWeek;

        $forApi = true;

        return Document::getDocuments($folder_id, $isWeek, $forApi);

    }

    public function getDocumentById($id)
    {
        return Document::getDocumentById($id);
    }

    public function getRecentDocuments($banner_id, $numberOfDays)
    {
        return Document::getRecentDocuments($banner_id, $numberOfDays);
    }
}
