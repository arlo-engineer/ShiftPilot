<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use App\Models\CompanyMembership;
use App\Models\User;

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
        if (User::where('name', $request->name)->where('email', $request->email)->exists()) {
            $requestUserId = User::where('name', $request->name)->pluck('id')->first();
            $company = new Company;
            $requestCompanyId = $company->getCompanyIdByAdminId(Auth::id())->first();
            CompanyMembership::create([
                'company_id' => $requestCompanyId,
                'user_id' => $requestUserId,
                'skills' => $request->skills,
            ]);
        } else {
            // dd('存在しません。');
            return response()->json(['message' => 'エラーが発生しました。']);
        }

        return to_route('admin.employees.index');
    }
}
