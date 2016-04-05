<?php

namespace App\Models\Feature;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeatureDocument extends Model
{
    use SoftDeletes;
    protected $table  = 'feature_document';
    protected $fillable = ['document_id', 'feature_id'];
    protected $dates = ['deleted_at'];
    
}
