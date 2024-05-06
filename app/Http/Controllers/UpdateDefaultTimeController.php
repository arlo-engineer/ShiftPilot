<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CompanyMembership;

class UpdateDefaultTimeController extends Controller
{
    public function update(Request $request)
    {
        $userId = Auth::id();
        $companyMembership = CompanyMembership::where('user_id', $userId)->first();
        $companyMembership->default_start_time = $request->default_start_time;
        $companyMembership->default_end_time = $request->default_end_time;
        $companyMembership->save();

        return to_route('profile.edit')->with('status', 'default-time-updated');
    }
}
