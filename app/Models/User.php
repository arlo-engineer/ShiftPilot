<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function companyMembership()
    {
        return $this->belongsTo(CompanyMembership::class, 'id', 'user_id');
    }

    // usersテーブルとcompany_membershipsテーブルを結合し、従業員情報を取得するメソッド
    public function getEmployees($company_id)
    {
        $userCompanyMemberships = User::with(['companyMembership' => function ($query) use ($company_id) {
            $query->where('company_id', $company_id);
        }])->get();
        $employees = [];
        foreach ($userCompanyMemberships as $userCompanyMembership) {
            if(!empty($userCompanyMembership->companyMembership)) {
                $employees[] = $userCompanyMembership;
            }
        }

        return $employees;
    }
}
