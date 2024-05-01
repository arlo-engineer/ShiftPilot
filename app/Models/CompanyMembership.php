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

    public function getCompanyIdByUserId($user_id)
    {
        return CompanyMembership::where('user_id', $user_id)->pluck('company_id')->first();
    }

    public function getCompanyMembershipIdByUserId()
    {
        // 会社ごとに表示切り替えを行えるようにするためには、この箇所を変更する可能性が高いと考える(要検討)
        $userId = Auth::id();
        $companyMembershipIdByUserId = CompanyMembership::where('user_id', $userId)->first()->id;
        return $companyMembershipIdByUserId;
    }
}
