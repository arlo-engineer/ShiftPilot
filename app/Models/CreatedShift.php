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
}
