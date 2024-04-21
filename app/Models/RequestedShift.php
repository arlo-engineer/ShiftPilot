<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RequestedShift extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_membership_id',
        'work_date',
        'start_time',
        'end_time',
        'notes',
    ];

    public function companyMembership()
    {
        return $this->belongsTo(CompanyMembership::class);
    }

    // requested_shiftsテーブルに存在しない日付を補完したデータを取得
    public function getFullShifts($nextMonth)
    {
        $company = new Company;
        $userId = Auth::id();
        $companyId = $company->getCompanyIdByAdminId($userId);
        $user = new User;
        $employees = $user->getEmployees($companyId);

        $calendar = new Calendar($nextMonth);
        $days = $calendar->getDays();

        $dateOnlyArray = array_map(function ($carbonInstance) {
            return $carbonInstance->format('Y-m-d');
        }, $days);

        foreach ($employees as $employee) {
            $RequestShiftWithMemberships = RequestedShift::with('companyMembership')->where('company_membership_id', $employee->id)->get();

            $RequestedWorkDays = [];
            foreach ($RequestShiftWithMemberships as $RequestShiftWithMembership) {
                $RequestedWorkDays[] = $RequestShiftWithMembership->work_date;
            }

            $CreateShiftWithMemberships = CreatedShift::with('companyMembership')->where('company_membership_id', $employee->id)->get();

            $CreatedWorkDays = [];
            foreach ($CreateShiftWithMemberships as $CreateShiftWithMembership) {
                $CreatedWorkDays[] = $CreateShiftWithMembership->work_date;
            }

            foreach ($dateOnlyArray as $date) {
                if (in_array($date, $RequestedWorkDays) && in_array($date, $CreatedWorkDays)) {
                    $requestedStartTime = $RequestShiftWithMemberships->where('work_date', $date)->first()->start_time;
                    $requestedEndTime = $RequestShiftWithMemberships->where('work_date', $date)->first()->end_time;
                    $createdStartTime = $CreateShiftWithMemberships->where('work_date', $date)->first()->start_time;
                    $createdEndTime = $CreateShiftWithMemberships->where('work_date', $date)->first()->end_time;
                    $fullShifts[]=['work_date'=>$date, 'employee_id'=>$employee->id, 'requested'=>['start_time'=>substr($requestedStartTime, 0, 5), 'end_time'=>substr($requestedEndTime, 0, 5)], 'created'=>['start_time'=>substr($createdStartTime, 0, 5), 'end_time'=>substr($createdEndTime, 0, 5)]];
                } else if (!in_array($date, $RequestedWorkDays) && in_array($date, $CreatedWorkDays)) {
                    $createdStartTime = $CreateShiftWithMemberships->where('work_date', $date)->first()->start_time;
                    $createdEndTime = $CreateShiftWithMemberships->where('work_date', $date)->first()->end_time;
                    $fullShifts[]=['employee_id'=>$employee->id, 'work_date'=>$date, 'requested'=>['start_time'=>'', 'end_time'=>''], 'created'=>['start_time'=>substr($createdStartTime, 0, 5), 'end_time'=>substr($createdEndTime, 0, 5)]];
                } else if (in_array($date, $RequestedWorkDays) && !in_array($date, $CreatedWorkDays)) {
                    $requestedStartTime = $RequestShiftWithMemberships->where('work_date', $date)->first()->start_time;
                    $requestedEndTime = $RequestShiftWithMemberships->where('work_date', $date)->first()->end_time;
                    $fullShifts[]=['employee_id'=>$employee->id, 'work_date'=>$date, 'requested'=>['start_time'=>substr($requestedStartTime, 0, 5), 'end_time'=>substr($requestedEndTime, 0, 5)], 'created'=>['start_time'=>'', 'end_time'=>'']];
                } else {
                    $fullShifts[]=['employee_id'=>$employee->id, 'work_date'=>$date, 'requested'=>['start_time'=>'', 'end_time'=>''], 'created'=>['start_time'=>'', 'end_time'=>'']];
                }
            }
        }

        return $fullShifts;
    }


    // この下のところで、nextMonth、nextMonthDatesArrayを取得する
    public function getNextMonth() {
        return Carbon::now()->addMonthNoOverflow()->format('Y-m');
    }

    public function getNextMonthDatesArray() {
        $nextMonthFirstDate = Carbon::now()->copy()->addMonthNoOverflow()->startOfMonth();
        $nextMonthDays = Carbon::now()->addMonthNoOverflow()->daysInMonth;
        $nextMonthDatesArray = [];
        for ($day = 1; $day <= $nextMonthDays; $day++) {
            $nextMonthDatesArray[] = $nextMonthFirstDate->copy()->addDays($day - 1)->format('Y-m-d');
        }
        return $nextMonthDatesArray;
    }
}
