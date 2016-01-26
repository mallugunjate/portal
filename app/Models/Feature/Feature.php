<?php

namespace App\Models\Feature;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
	use SoftDeletes;
    protected $table = 'features';
    protected $dates = ['deleted_at'];
    protected $fillable = ['banner_id', 'title', 'description', 'start', 'end'];
}
