<?php

namespace App\Models\Communication;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommunicationType extends Model
{
	use SoftDeletes;
    protected $table = 'communication_types';
    protected $dates = ['deleted_at'];
    protected $fillable = ['communication_type', 'banner_id', 'colour'];
}
