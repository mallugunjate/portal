<?php

namespace App\Models\Utility;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Utility extends Model
{
	public static function prettifyDate($date)
	{

		$prettyDate = Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('D j F');
		return $prettyDate;

	}

	public static function getTimePastSinceDate($date)
	{
		$date = Carbon::createFromFormat('Y-m-d H:i:s', $date);
		$since = Carbon::now()->diffForHumans($date, true);
		return $since;
	}

}
