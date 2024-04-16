<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    // requested_shiftsテーブルとcompany_membershipsテーブルを結合したデータの取得
    public function joinCompanyMemberships()
    {
        $shiftsWithMemberships = RequestedShift::with('companyMembership')->get();
        return $shiftsWithMemberships;
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
