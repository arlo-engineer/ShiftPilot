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

        return view('admin.employee.manage_employee', compact('employees'));
    }

    public function create()
    {
        return view('admin.employee.add_employee');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', new ExistedNameInUsers],
            'email' => ['required', new ExistedEmailInUsers, new UniqueEmailInCompanyMemberShips],
        ],
        [
            'name.required' => '名前は必須です。',
            'email.required' => 'メールアドレスは必須です。',
        ]);

        $requestUserId = User::where('email', $request->email)->pluck('id')->first();
        $company = new Company;
        $requestCompanyId = $company->getCompanyIdByAdminId(Auth::id())->first();
        CompanyMembership::create([
            'company_id' => $requestCompanyId,
            'user_id' => $requestUserId,
            'skills' => $request->skills,
            'remarks' => $request->remarks,
        ]);

        return to_route('admin.employees.index');
    }

    public function edit(string $id)
    {
        $company = new Company;
        $userId = Auth::id();
        $companyId = $company->getCompanyIdByAdminId($userId);
        $user = new User;
        $employees = $user->getEmployees($companyId);

        foreach ($employees as $employee) {
            if ($employee->CompanyMembership->id == $id) {
                return view('admin.employee.edit_employee', compact('employee'));
            }
        }
    }

    public function update(Request $request, $id)
    {
        $employeeInfo = CompanyMembership::find($id);
        $employeeInfo->skills = $request->skills;
        $employeeInfo->remarks = $request->remarks;
        $employeeInfo->save();

        return to_route('admin.employees.index');
    }

    public function destroy($id)
    {
        $employeeInfo = CompanyMembership::find($id);
        $employeeInfo->delete();

        return to_route('admin.employees.index');
    }
}
