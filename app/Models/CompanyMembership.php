<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CompanyMembership extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'user_id',
        'skills',
        'remarks',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    public function requestedShifts()
    {
        return $this->hasMany(RequestedShift::class, 'company_membership_id', 'id');
    }

    public function createdShifts()
    {
        return $this->hasMany(CreatedShift::class, 'company_membership_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'id', 'company_id');
    }

    public function getCompanyIdByUserId()
    {
        $user_id = Auth::id();
        return CompanyMembership::where('user_id', $user_id)->pluck('company_id')->first();
    }

    public function getCompanyNameByUserId()
    {
        $user_id = Auth::id();
        $company_id = CompanyMembership::where('user_id', $user_id)->pluck('company_id')->first();
        return Company::where('id', $company_id)->pluck('name')->first();
    }

    public function getCompanyMembershipIdByUserId()
    {
        // 会社ごとに表示切り替えを行えるようにするためには、この箇所を変更する可能性が高いと考える(要検討)
        $userId = Auth::id();
        if (!empty(CompanyMembership::where('user_id', $userId)->first())) {
            $companyMembershipIdByUserId = CompanyMembership::where('user_id', $userId)->first()->id;
            return $companyMembershipIdByUserId;
        } else {
            $companyMembershipIdByUserId = "";
            return $companyMembershipIdByUserId;
        }
    }

    // スタッフがシフト提出する際に、デフォルト/初期値として表示される時間
    public function getDefaultTime()
    {
        $userId = Auth::id();
        $defaultTime = CompanyMembership::where('user_id', $userId)->select('default_start_time', 'default_end_time')->first();
        return $defaultTime;
    }
}
