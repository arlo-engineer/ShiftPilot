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
            // 'skills' => ['required'],
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
                return view('admin.edit_employee', compact('employee'));
            }
        }
    }

    public function update(Request $request, $id)
    {
        // $updateBook = $this->book->updateBook($request, $book);

        // $contact変数名は後ほど変更
        $contact = CompanyMembership::find($id);

        $contact->skills = $request->skills;
        $contact->remarks = $request->remarks;
        $contact->save();

        return to_route('admin.employees.index');
    }

    public function destroy($id)
    {
        // $contact変数名は後ほど変更
        $contact = CompanyMembership::find($id);
        $contact->delete();

        return to_route('admin.employees.index');
    }
}
