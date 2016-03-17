<?php

namespace App\Models\Feature;

use Illuminate\Database\Eloquent\Model;

class FeaturePackage extends Model
{
    protected $table = 'feature_package';
    protected $fillable = ['feature_id', 'package_id', 'order'];
}
