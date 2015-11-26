<?php

namespace App\Models\Profile;

use Illuminate\Database\Eloquent\Model;

class Move extends Model
{
    protected $table = "moves";

    public static function getMovesList()
    {
    	$moves = Move::lists('distance', 'id');
    	return $moves;
    }
}
