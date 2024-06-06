<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Calendar;
use App\Models\CompanyMembership;
use App\Models\CreatedShift;
use App\Models\User;
use App\Models\RequestedShift;

class ConfirmShiftController extends Controller
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
        $companyMembership = new CompanyMembership();
        $userId = Auth::id();
        $companyId = $companyMembership->getCompanyIdByUserId();
        $user = new User;
        $employees = $user->getEmployees($companyId);
        $requestedShift = new RequestedShift();
        $fullShifts = $requestedShift->getFullShifts($month, $employees);
        $createdShifts = new CreatedShift();
        $fullCreatedShiftsPerEmployee = $createdShifts->getCreatedShiftsPerEmployee($month);

        if (!empty($employees)) {
            return view('confirm_shift', compact('calendar', 'days', 'employees', 'fullShifts', 'userId', 'fullCreatedShiftsPerEmployee'));
        } else {
            return view('no-company');
        }
    }
}
