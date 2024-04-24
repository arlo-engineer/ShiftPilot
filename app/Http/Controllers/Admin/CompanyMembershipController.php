<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use App\Models\CompanyMembership;
use App\Models\User;
use App\Rules\ExistedEmailInUsers;
use App\Rules\ExistedNameInUsers;
use App\Rules\UniqueEmailInCompanyMemberShips;

class CompanyMembershipController extends Controller
{
    public function index()
    {
        $company = new Company;
        $userId = Auth::id();
        $companyId = $company->getCompanyIdByAdminId($userId);
        $user = new User;
        $employees = $user->getEmployees($companyId);
        // dd($employees);

        return view('admin.manage_employee', compact('employees'));
    }

    public function create()
    {
        return view('admin.add_employee');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', new ExistedNameInUsers],
            'email' => ['required', new ExistedEmailInUsers, new UniqueEmailInCompanyMemberShips],
            'skills' => ['required', 'numeric'],
        ],
        [
            'name.required' => '名前は必須です。',
            'email.required' => 'メールアドレスは必須です。',
            'skills.required' => 'スキルは必須です。',
            'skills.numeric' => 'スキルは数字を入力してください。',
        ]);

        $requestUserId = User::where('email', $request->email)->pluck('id')->first();
        $company = new Company;
        $requestCompanyId = $company->getCompanyIdByAdminId(Auth::id())->first();
        CompanyMembership::create([
            'company_id' => $requestCompanyId,
            'user_id' => $requestUserId,
            'skills' => $request->skills,
        ]);

        return to_route('admin.employees.index');
    }
}
