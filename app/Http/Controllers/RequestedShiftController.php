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

        $requestedShifts = new RequestedShift();
        $fullRequestedShiftsPerEmployee = $requestedShifts->getRequestedShiftsPerEmployee($nextMonth);

        return view('shift.requested_shift', compact('calendar', 'days', 'companyMembership', 'fullRequestedShiftsPerEmployee'));
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

        $nextMonth = Carbon::createFromFormat('Y-m-d', $date)->format('Y-m');
        $requestedShifts = new RequestedShift();
        $fullRequestedShiftsPerEmployee = $requestedShifts->getRequestedShiftsPerEmployee($nextMonth);
        $flattenedArray = array_merge(...$fullRequestedShiftsPerEmployee);

        for($i = 0; $i < count($flattenedArray); $i++) {
            $existingData = RequestedShift::where('company_membership_id', $request->company_membership_id[$i])->where('work_date', $request->work_date[$i])->first();
            if ($request->store_option[$i] == "1") {
                // requested_shifts_table内にユーザーと日付が一致するデータがある場合は、上書き保存する
                if ($existingData) {
                    $existingData->company_membership_id = $request->company_membership_id[$i];
                    $existingData->work_date = $request->work_date[$i];
                    $existingData->start_time = $request->start_time[$i];
                    $existingData->end_time = $request->end_time[$i];
                    $existingData->save();
                } else {
                    RequestedShift::create([
                        'company_membership_id' => $request->company_membership_id[$i],
                        'work_date' => $request->work_date[$i],
                        'start_time' => $request->start_time[$i],
                        'end_time' => $request->end_time[$i],
                        // 後ほど実装予定
                        'notes' => '',
                    ]);
                }
            } else if ($request->store_option[$i] == "2") {
                $existingData->delete();
            }
        }

        return redirect(url()->previous());
    }
}
