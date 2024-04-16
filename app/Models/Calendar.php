<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Calendar extends Model
{
    use HasFactory;

    private $carbon;

    function __construct($date) {
		return $this->carbon = new Carbon($date);
	}

    public function getCalenderTitle() {
        return $this->carbon->format('Y年n月');
    }

    function getDays() {
		$days = [];
		$firstDay = $this->carbon->copy()->startOfMonth();
		$lastDay = $this->carbon->copy()->endOfMonth();
		$tmpDay = $firstDay->copy();
		//月曜日〜日曜日までループ
		while ($tmpDay->lte($lastDay)) {
			//今月
			$day = $this->__construct($tmpDay->copy());
			$days[] = $day;
			//翌日に移動
			$tmpDay->addDay(1);
		}

		return $days;
	}
}
