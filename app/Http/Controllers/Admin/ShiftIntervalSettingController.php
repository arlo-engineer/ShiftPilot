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
        $company->save();

        return to_route('admin.profile.edit')->with('status', 'shift-interval-updated');
    }
}
