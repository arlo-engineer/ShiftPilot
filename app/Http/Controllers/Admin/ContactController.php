<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Company;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactSendmail;

class ContactController extends Controller
{
    public function index()
    {
        $company = new Company();
        $companyName = $company->getCompanyNameByAdminId();
        return view('admin.contact', compact('companyName'));
    }
}
