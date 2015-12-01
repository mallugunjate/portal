<?php

namespace App\Models\Document;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Year extends Model
{
    protected $table = 'years';

    public static function getCurrentYear()
    {
		$today = Carbon::now()->toDateString();
		$currentYear = Year::where('start', '<=', $today)->where('end', '>=', $today )->first();
		return $currentYear;
		 	
    }

}
