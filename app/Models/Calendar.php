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

    public function getCalendarTitle() {
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

    public function getNextMonth() {
        return $this->carbon->copy()->addMonthsNoOverflow()->format('Y-m');
    }

    public function getPreviousMonth() {
        return $this->carbon->copy()->subMonthsNoOverflow()->format('Y-m');
    }

    function getWeeks() {
		$weeks = [];
        $days = [];

		// 今月初日を取得
		$firstDay = $this->carbon->copy()->firstOfMonth();

		// 今月末を取得
		$lastDay = $this->carbon->copy()->lastOfMonth();

        // 先月末を取得
        $lastDayOfLastMonth = $this->carbon->copy()->subMonthNoOverflow()->endOfMonth();

        // 来月初日を取得
        $firstDayOfNextMonth = $this->carbon->copy()->addMonthNoOverflow()->firstOfMonth();

        // 前月の月曜日から今月初日以前まで
        $tmpLastDayOfLastMonth = $lastDayOfLastMonth->subDay($firstDay->format('w') - 1);
        for ($i = 0; $i < $firstDay->format('w'); $i++) {
            $days[] = $tmpLastDayOfLastMonth->copy();
            $tmpLastDayOfLastMonth->addDay(1);
        }

        // 今月初日から末まで
        $tmpDay = $firstDay->copy();
        while ($tmpDay->lte($lastDay)) {
			//今月
			$day = $this->__construct($tmpDay->copy());
			$days[] = $day;
			//翌日に移動
			$tmpDay->addDay(1);
		}

        // 今月末以降から来月の日曜日まで
        $tmpFirstDayOfNextMonth = $firstDayOfNextMonth->copy();
        for ($i = 0; $i < 6 - ($lastDay->format('w')); $i++) {
            $days[] = $tmpFirstDayOfNextMonth->copy();
            $tmpFirstDayOfNextMonth->addDay(1);
        }

        $weeks = array_chunk($days, 7);

		return $weeks;
	}

    // 半月分でシフトを提出するときに使用(今後実装予定)
    // function getFirstHalfWeeks() {
	// 	$weeks = [];
    //     $days = [];

	// 	// 今月初日を取得
	// 	$firstDay = $this->carbon->copy()->firstOfMonth();

    //     // 今月15日を取得
    //     $fifteenthDay = $firstDay->copy()->addDays(14);

    //     // 今月16日を取得
    //     $sixteenthDay = $firstDay->copy()->addDays(15);

	// 	// 今月末を取得
	// 	$lastDay = $this->carbon->copy()->lastOfMonth();

    //     // 先月末を取得
    //     $lastDayOfLastMonth = $this->carbon->copy()->subMonthNoOverflow()->endOfMonth();

    //     // 来月初日を取得
    //     $firstDayOfNextMonth = $this->carbon->copy()->addMonthNoOverflow()->firstOfMonth();

    //     // 前月の月曜日から今月初日以前まで
    //     $tmpLastDayOfLastMonth = $lastDayOfLastMonth->subDay($firstDay->format('w') - 1);
    //     for ($i = 0; $i < $firstDay->format('w'); $i++) {
    //         $days[] = $tmpLastDayOfLastMonth->copy();
    //         $tmpLastDayOfLastMonth->addDay(1);
    //     }

    //     // 今月初日から15日まで
    //     $tmpDay = $firstDay->copy();
    //     while ($tmpDay->lte($fifteenthDay)) {
	// 		//今月
	// 		$day = $this->__construct($tmpDay->copy());
	// 		$days[] = $day;
	// 		//翌日に移動
	// 		$tmpDay->addDay(1);
	// 	}

    //     // 今月の15日以降からその週の日曜日まで
    //     $tmpSixteenthDay = $sixteenthDay->copy();
    //     for ($i = 0; $i < 6 - ($fifteenthDay->format('w')); $i++) {
    //         $days[] = $tmpSixteenthDay->copy();
    //         $tmpSixteenthDay->addDay(1);
    //     }

    //     $weeks = array_chunk($days, 7);

	// 	return $weeks;
	// }
}
