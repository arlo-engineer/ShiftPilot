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

    // requested_shiftsテーブルとcompany_membershipsテーブルを結合し、company_idで絞り込んだデータの取得
    // public function getPartialRequestedShifts($company_id, $nextMonth)
    // {
    //     $partialRequestedShifts = RequestedShift::whereHas('companyMembership', function ($query) use ($company_id) {
    //             $query->where('company_id', $company_id);
    //         })
    //         ->whereRaw("LEFT(work_date, 7) = ?", [$nextMonth])
    //         ->get();

    //     return $partialRequestedShifts;
    // }

    // requested_shiftsテーブルに存在しない日付を補完したデータを取得
    public function getFullRequestedShifts($nextMonth)
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

            foreach ($dateOnlyArray as $date) {
                if (in_array($date, $RequestedWorkDays)) {
                    // 従業員が提出するシフト(requested_shifts_table)に入力/保存するときにhh:mmの型に限定すれば、substr関数を使用しなくてよくなる(要確認)
                    $startTime = $RequestShiftWithMemberships->where('work_date', $date)->first()->start_time;
                    $endTime = $RequestShiftWithMemberships->where('work_date', $date)->first()->end_time;
                    $fullRequestedShifts[]=['employee_id'=>$employee->id, 'work_date'=>$date, 'start_time'=>substr($startTime, 0, 5), 'end_time'=>substr($endTime, 0, 5)];
                } else {
                    $fullRequestedShifts[]=['employee_id'=>$employee->id, 'work_date'=>$date, 'start_time'=>'', 'end_time'=>''];
                }
            }
        }

        return $fullRequestedShifts;
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
