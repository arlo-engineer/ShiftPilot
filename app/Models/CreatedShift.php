<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreatedShift extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_membership_id',
        'work_date',
        'start_time',
        'end_time',
    ];

    public function companyMembership()
    {
        return $this->belongsTo(CompanyMembership::class);
    }

    /**
     * 遷移前のページのクエリーパラメーターの値を取得する
     *
     * @param string $key クエリーパラメーターのキー
     * @return string|null キーに対応するクエリーパラメーターの値。キーが存在しない場合はnullを返す
     */
    public static function getPreviousPageQueryValue($key)
    {
        $previousUrl = url()->previous();
        $queryKey = '?' . $key . '=';
        if (strpos($previousUrl, $queryKey)) {
            $queryValue = substr($previousUrl, strpos($previousUrl, $queryKey) + mb_strlen($queryKey));
        } else {
            $queryValue = '';
        }

        return $queryValue;
    }

    /**
     * 指定した月の従業員ごとの作成済みシフトを取得する
     *
     * このメソッドは、指定した月における従業員の作成済みシフトを取得し、
     * 各日がシフトを持つかどうか（シフトがある場合は開始時間と終了時間を含む）を示す配列を返す
     *
     * @param string $month シフトを取得する月（形式: 'YYYY-MM'）
     * @return array 各週を含む配列で、各日が作成済みシフトの詳細またはnullを持つ
     */
    public function getCreatedShiftsPerEmployee($month)
    {
        $companyMembership = new CompanyMembership();
        $companyMembershipIdByUserId = $companyMembership->getCompanyMembershipIdByUserId();
        $createdShiftsPerEmployee = CreatedShift::where('company_membership_id', $companyMembershipIdByUserId)->get();

        $calendar = new Calendar($month);
        $weeks = $calendar->getWeeks();

        $createdWorkDays = [];
        foreach ($createdShiftsPerEmployee as $createdShiftPerEmployee) {
            $createdWorkDays[] = $createdShiftPerEmployee->work_date;
        }

        foreach ($weeks as $week) {
            for ($i = 0; $i < 7; $i++) {
                if (in_array($week[$i]->format('Y-m-d'), $createdWorkDays)) {
                    $createdStartTime = $createdShiftsPerEmployee->where('work_date', $week[$i]->format('Y-m-d'))->first()->start_time;
                    $createdEndTime = $createdShiftsPerEmployee->where('work_date', $week[$i]->format('Y-m-d'))->first()->end_time;
                    $fllCreatedShiftsPerEmployee[] = ['day'=>$week[$i], 'created'=>['start_time'=>$createdStartTime, 'end_time'=>$createdEndTime]];
                } else {
                    $fllCreatedShiftsPerEmployee[] = ['day'=>$week[$i], 'created'=>null];
                }
            }
        }

        $fllCreatedShiftsPerEmployee = array_chunk($fllCreatedShiftsPerEmployee, 7);

        return $fllCreatedShiftsPerEmployee;
    }
}
