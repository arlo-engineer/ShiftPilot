<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyMembership extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'user_id',
        'skills',
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
}
