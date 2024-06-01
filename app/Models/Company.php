<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'admin_id',
        'shift_interval',
        'notification_days',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function companyMemberships()
    {
        return $this->hasMany(CompanyMembership::class, 'company_id', 'id');
    }

    public function getCompanyIdByAdminId($admin_id)
    {
        return Company::where('admin_id', $admin_id)->pluck('id');
    }

    public function getCompanyNameByAdminId()
    {
        $admin_id = Auth::id();
        return Company::where('admin_id', $admin_id)->pluck('name')->first();
    }

    /**
     * シフト提出締切の近い従業員への通知メールアドレスを取得する関数
     *
     * シフト提出の第一締切および第二締切に基づき、各会社の通知設定に従って
     * 通知日が今日に該当する従業員のメールアドレスを取得する。
     *
     * @return array 通知メールアドレスの配列
     */
    public static function getNotificationEmails()
    {
        $emails = [];
        // テスト用
        $today = Carbon::createFromFormat('Y-m-d', '2024-06-29');
        // $today = Carbon::now();
        $day15 = Carbon::now()->day(15);
        $monthEnd = Carbon::now()->endOfMonth();
        $halfMonthCompanies = Company::where('shift_interval', '半月毎')->get();
        foreach ($halfMonthCompanies as $halfMonthCompany) {
            $firstDeadline = (clone $day15)->subDays($halfMonthCompany['first_deadline']);
            $first_notificationDays = (clone $firstDeadline)->subDays($halfMonthCompany['notification_days']);
            if ($first_notificationDays->isSameDays($today)) {
                $userIdsByCompany = CompanyMembership::where('company_id', $halfMonthCompany['id'])->pluck('user_id');
                foreach ($userIdsByCompany as $userId) {
                    $emails[] = User::where('id', $userId)->pluck('email')->first();
                }
            }
        }

        $allCompanies = Company::get();
        foreach ($allCompanies as $allCompany) {
            $secondDeadline = (clone $monthEnd)->subDays($allCompany['second_deadline']);
            $second_notificationDays = (clone $secondDeadline)->subDays($allCompany['notification_days']);
            if ($second_notificationDays->isSameDays($today)) {
                $userIdsByCompany = CompanyMembership::where('company_id', $allCompany['id'])->pluck('user_id');
                foreach ($userIdsByCompany as $userId) {
                    $emails[] = User::where('id', $userId)->pluck('email')->first();
                }
            }
        }

        return $emails;
    }
}
