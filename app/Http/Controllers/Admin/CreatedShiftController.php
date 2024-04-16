<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Calendar;
use App\Models\Company;
use App\Models\User;
use App\Models\RequestedShift;
use App\Models\CreatedShift;

class CreatedShiftController extends Controller
{
    public function create()
    {
    // Calendar
    $nextMonth = Carbon::now()->addMonthNoOverflow()->format('Y-m');
    $calendar = new Calendar($nextMonth);
    $calendarTitle = $calendar->getCalenderTitle();
    $days = $calendar->getDays();
    $company = new Company;
    $userId = Auth::id();
    $companyId = $company->getCompanyIdByAdminId($userId);
    $user = new User;
    $employees = $user->getEmployees($companyId);

    // Modal
    $requestedShift = new requestedShift();
    $shiftsWithMemberships = $requestedShift->joinCompanyMemberships();
    $nextMonthDatesArray = $requestedShift->getNextMonthDatesArray();

    return view('admin.shift.created_shift', compact('calendarTitle', 'days', 'nextMonth', 'employees', 'shiftsWithMemberships', 'nextMonthDatesArray'));
    }

    public function store(Request $request)
    {
        $company = new Company;
        $userId = Auth::id();
        $companyId = $company->getCompanyIdByAdminId($userId);
        $user = new User;
        $employees = $user->getEmployees($companyId);
        $requestedShift = new requestedShift();
        $nextMonthDatesArray = $requestedShift->getNextMonthDatesArray();

        for($i = 0; $i < count($employees) * count($nextMonthDatesArray); $i++) {
            if ($request->store_option[$i] == "1") {
                CreatedShift::create([
                    'company_membership_id' => $request->company_membership_id[$i],
                    'work_date' => $request->work_date[$i],
                    'start_time' => $request->start_time[$i],
                    'end_time' => $request->end_time[$i],
                ]);
            }
        }

        return to_route('admin.dashboard');
    }
}
