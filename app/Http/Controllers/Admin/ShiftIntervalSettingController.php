<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;

class ShiftIntervalSettingController extends Controller
{
    public function update(Request $request) {
        $adminId = Auth::id();
        $company = Company::where('admin_id', $adminId)->first();
        $company->shift_interval = $request->shift_interval;
        if ($request->shift_interval == '1ヶ月毎') {
            $company->first_deadline = $request->first_deadline_1;
            $company->second_deadline = $request->second_deadline_1;
        } elseif ($request->shift_interval == '半月毎') {
            $company->first_deadline = $request->first_deadline_2;
            $company->second_deadline = $request->second_deadline_2;
        }
        $company->save();

        return to_route('admin.profile.edit')->with('status', 'shift-interval-updated');
    }
}
