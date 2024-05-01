<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calendar;
use App\Models\CompanyMembership;
use App\Models\RequestedShift;
use Carbon\Carbon;

class RequestedShiftController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('date');
        if ($date && preg_match("/^[0-9]{4}-[0-9]{2}$/", $date)) {
            $date = $date . '-01';
        } else if (!$date) {
            $date = Carbon::now()->addMonthNoOverflow()->format('Y-m-d');
        } else {
            $date = null;
        }

        $companyMembership = new CompanyMembership();

        $nextMonth = Carbon::createFromFormat('Y-m-d', $date)->format('Y-m');
        $calendar = new Calendar($nextMonth);
        $days = $calendar->getDays();
        // $weeks = $calendar->getWeeks();

        $requestedShifts = new RequestedShift();
        $fullRequestedShiftsPerEmployee = $requestedShifts->getRequestedShiftsPerEmployee($nextMonth);
        // dd($fullRequestedShiftsPerEmployee);

        return view('shift.requested_shift', compact('calendar', 'days', 'companyMembership', 'fullRequestedShiftsPerEmployee'));
    }
}
