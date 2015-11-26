<?php

namespace App\Models\Profile;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $table = "career_paths";

    public static function getCareersList()
    {
    	return Career::lists('path', 'id');
    }
}
