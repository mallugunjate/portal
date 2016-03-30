<?php

namespace App\Models\Feature;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeaturePackage extends Model
{
    use SoftDeletes;
    protected $table = 'feature_package';
    protected $fillable = ['feature_id', 'package_id', 'order'];
    protected $dates = ['deleted_at'];
}
