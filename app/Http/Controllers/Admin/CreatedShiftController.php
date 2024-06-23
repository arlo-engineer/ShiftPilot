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
use Illuminate\Support\Facades\Log;

class CreatedShiftController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('date');
        $date = Calendar::convertYearMonthToYearMonthDay($date);
        $month = Carbon::createFromFormat('Y-m-d', $date)->format('Y-m');
        $calendar = new Calendar($month);
        $days = $calendar->getDays();
        $company = new Company;
        $adminId = Auth::id();
        $companyId = $company->getCompanyIdByAdminId($adminId);
        $user = new User;
        $employees = $user->getEmployees($companyId);
        $requestedShift = new RequestedShift();
        $fullShifts = $requestedShift->getFullShifts($month, $employees);

        return view('admin.shift.created_shift', compact('calendar', 'days', 'employees', 'fullShifts'));
    }

    public function store(Request $request)
    {
        $date = CreatedShift::getPreviousPageQueryValue('date');
        $date = Calendar::convertYearMonthToYearMonthDay($date);
        $month = Carbon::createFromFormat('Y-m-d', $date)->format('Y-m');
        $calendar = new Calendar($month);
        $days = $calendar->getDays();
        $company = new Company;
        $adminId = Auth::id();
        $companyId = $company->getCompanyIdByAdminId($adminId);
        $user = new User;
        $employees = $user->getEmployees($companyId);

        for($i = 0; $i < count($employees) * count($days); $i++) {
            $test = $request->data['data'][$i];
            if ($test['store_option'] == "1") {
                $existingData = CreatedShift::where('company_membership_id', $test['company_membership_id'])->where('work_date', $test['work_date'])->first();
                if (!empty($existingData)) {
                    $existingData->company_membership_id = $test['company_membership_id'];
                    $existingData->work_date = $test['work_date'];
                    $existingData->start_time = $test['start_time'];
                    $existingData->end_time = $test['end_time'];
                    $existingData->save();
                } else {
                    CreatedShift::create([
                        'company_membership_id' => $test['company_membership_id'],
                        'work_date' => $test['work_date'],
                        'start_time' => $test['start_time'],
                        'end_time' => $test['end_time'],
                    ]);
                }
            } else if ($test['store_option'] == "2") {
                $existingData = CreatedShift::where('company_membership_id', $test['company_membership_id'])->where('work_date', $test['work_date'])->first();
                $existingData->delete();
            }
        }
        return back();
    }
}
