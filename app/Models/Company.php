<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'admin_id',
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
}
