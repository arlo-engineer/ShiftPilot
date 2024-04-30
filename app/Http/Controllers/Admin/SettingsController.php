<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;

class SettingsController extends Controller
{
    public function edit() {
        $userId = Auth::id();
        $company = Company::where('admin_id', $userId)->first();
        return view('admin.setting.setting', compact('company'));
    }

    public function update(Request $request) {
        $userId = Auth::id();
        $company = Company::where('admin_id', $userId)->first();
        $company->name = $request->company_name;
        $company->save();

        return to_route('admin.setting.edit')->with('status', 'company-name-updated');
    }
}
