<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
