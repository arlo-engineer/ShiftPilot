<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;

class NotificationDeadlineSettingController extends Controller
{
    public function update(Request $request) {
        $adminId = Auth::id();
        $company = Company::where('admin_id', $adminId)->first();
        $company->notification_days = $request->notification_days;
        $company->save();

        return to_route('admin.profile.edit')->with('status', 'notification-deadline-updated');
    }
}
