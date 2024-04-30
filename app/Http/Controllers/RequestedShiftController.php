<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calendar;
use Carbon\Carbon;

class RequestedShiftController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('date');
        if ($date && preg_match("/^[0-9]{4}-[0-9]{2}$/", $date)) {
            $date = $date . '-01';
        } else if (!$date) {
            $date = Carbon::now()->format('Y-m-d');
        } else {
            $date = null;
        }

        $month = Carbon::createFromFormat('Y-m-d', $date)->format('Y-m');
        $calendar = new Calendar($month);
        $days = $calendar->getDays();
        $weeks = $calendar->getWeeks();
        return view('requested_shift', compact('calendar', 'weeks', 'days'));
    }
}
