<?php

namespace App\Models\Feature;

use Illuminate\Database\Eloquent\Model;

class FeatureDocument extends Model
{
    protected $table  = 'feature_document';
    protected $fillable = ['document_id', 'feature_id'];
    
}
