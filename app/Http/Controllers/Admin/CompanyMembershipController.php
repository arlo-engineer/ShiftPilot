<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use App\Models\User;

class CompanyMembershipController extends Controller
{
    public function index() {
        $company = new Company;
        $userId = Auth::id();
        $companyId = $company->getCompanyIdByAdminId($userId);
        $user = new User;
        $employees = $user->getEmployees($companyId);
        // dd($employees);

        return view('admin.manage_employee', compact('employees'));
    }

    public function create() {
        //
    }
}
