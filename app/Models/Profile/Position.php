<?php

namespace App\Models\Profile;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table = 'positions';


    public static function getPositionsList()
    {
    	return Position::lists('name', 'id');
    }
}
