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


use App\Models\CompanyMembership;

class CreatedShiftController extends Controller
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
        $company = new Company;
        $adminId = Auth::id();
        $companyId = $company->getCompanyIdByAdminId($adminId);
        $user = new User;
        $employees = $user->getEmployees($companyId);

        for($i = 0; $i < count($employees) * count($days); $i++) {
            $existingData = CreatedShift::where('company_membership_id', $request->company_membership_id[$i])->where('work_date', $request->work_date[$i])->first();
            if ($request->store_option[$i] == "1") {
                // created_shifts_table内にユーザーと日付が一致するデータがある場合は、上書き保存する
                if ($existingData) {
                    $existingData->company_membership_id = $request->company_membership_id[$i];
                    $existingData->work_date = $request->work_date[$i];
                    $existingData->start_time = $request->start_time[$i];
                    $existingData->end_time = $request->end_time[$i];
                    $existingData->save();
                } else {
                    CreatedShift::create([
                        'company_membership_id' => $request->company_membership_id[$i],
                        'work_date' => $request->work_date[$i],
                        'start_time' => $request->start_time[$i],
                        'end_time' => $request->end_time[$i],
                    ]);
                }
            } else if ($request->store_option[$i] == "2") {
                $existingData->delete();
            }
        }

        return redirect(url()->previous());
    }
}
