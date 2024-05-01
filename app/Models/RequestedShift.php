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

    // シフト提出ページ用
    // requested_shiftsテーブルに存在しない日付を保管したデータの取得
    public function getRequestedShiftsPerEmployee($month)
    {
        $companyMembership = new CompanyMembership();
        $companyMembershipIdByUserId = $companyMembership->getCompanyMembershipIdByUserId();
        $requestedShiftsPerEmployee = RequestedShift::where('company_membership_id', $companyMembershipIdByUserId)->get();

        $calendar = new Calendar($month);
        $weeks = $calendar->getWeeks();

        $requestedWorkDays = [];
        foreach ($requestedShiftsPerEmployee as $requestedShiftPerEmployee) {
            $requestedWorkDays[] = $requestedShiftPerEmployee->work_date;
        }

        foreach ($weeks as $week) {
            for ($i = 0; $i < 7; $i++) {
                if (in_array($week[$i]->format('Y-m-d'), $requestedWorkDays)) {
                    $requestedStartTime = $requestedShiftsPerEmployee->where('work_date', $week[$i]->format('Y-m-d'))->first()->start_time;
                    $requestedEndTime = $requestedShiftsPerEmployee->where('work_date', $week[$i]->format('Y-m-d'))->first()->end_time;
                    $fullRequestedShiftsPerEmployee[] = ['day'=>$week[$i], 'requested'=>['start_time'=>$requestedStartTime, 'end_time'=>$requestedEndTime]];
                } else {
                    $fullRequestedShiftsPerEmployee[] = ['day'=>$week[$i], 'requested'=>null];
                }
            }
        }

        $fullRequestedShiftsPerEmployee = array_chunk($fullRequestedShiftsPerEmployee, 7);

        return $fullRequestedShiftsPerEmployee;
    }


    // シフト作成ページ兼シフト確認ページ用
    // requested_shiftsテーブルとcreated_shiftsテーブルを結合したデータの取得
    public function getFullShifts($month, $employees)
    {
        $calendar = new Calendar($month);
        $days = $calendar->getDays();

        if ($employees) {
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

                foreach ($days as $day) {
                    if (in_array($day->format('Y-m-d'), $RequestedWorkDays) && in_array($day->format('Y-m-d'), $CreatedWorkDays)) {
                        $requestedStartTime = $RequestShiftWithMemberships->where('work_date', $day->format('Y-m-d'))->first()->start_time;
                        $requestedEndTime = $RequestShiftWithMemberships->where('work_date', $day->format('Y-m-d'))->first()->end_time;
                        $createdStartTime = $CreateShiftWithMemberships->where('work_date', $day->format('Y-m-d'))->first()->start_time;
                        $createdEndTime = $CreateShiftWithMemberships->where('work_date', $day->format('Y-m-d'))->first()->end_time;
                        $fullShifts[]=['work_date'=>$day, 'employee_id'=>$employee->id, 'requested'=>['start_time'=>substr($requestedStartTime, 0, 5), 'end_time'=>substr($requestedEndTime, 0, 5)], 'created'=>['start_time'=>substr($createdStartTime, 0, 5), 'end_time'=>substr($createdEndTime, 0, 5)]];
                    } else if (!in_array($day->format('Y-m-d'), $RequestedWorkDays) && in_array($day->format('Y-m-d'), $CreatedWorkDays)) {
                        $createdStartTime = $CreateShiftWithMemberships->where('work_date', $day->format('Y-m-d'))->first()->start_time;
                        $createdEndTime = $CreateShiftWithMemberships->where('work_date', $day->format('Y-m-d'))->first()->end_time;
                        $fullShifts[]=['work_date'=>$day, 'employee_id'=>$employee->id, 'requested'=>['start_time'=>'', 'end_time'=>''], 'created'=>['start_time'=>substr($createdStartTime, 0, 5), 'end_time'=>substr($createdEndTime, 0, 5)]];
                    } else if (in_array($day->format('Y-m-d'), $RequestedWorkDays) && !in_array($day->format('Y-m-d'), $CreatedWorkDays)) {
                        $requestedStartTime = $RequestShiftWithMemberships->where('work_date', $day->format('Y-m-d'))->first()->start_time;
                        $requestedEndTime = $RequestShiftWithMemberships->where('work_date', $day->format('Y-m-d'))->first()->end_time;
                        $fullShifts[]=['work_date'=>$day, 'employee_id'=>$employee->id, 'requested'=>['start_time'=>substr($requestedStartTime, 0, 5), 'end_time'=>substr($requestedEndTime, 0, 5)], 'created'=>['start_time'=>'', 'end_time'=>'']];
                    } else {
                        $fullShifts[]=['work_date'=>$day, 'employee_id'=>$employee->id, 'requested'=>['start_time'=>'', 'end_time'=>''], 'created'=>['start_time'=>'', 'end_time'=>'']];
                    }
                }
            }
            return $fullShifts;
        }
    }
}
