<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\CompanyMembership;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactSendmail;

class ContactController extends Controller
{
    public function index()
    {
        $companyMembership = new CompanyMembership();
        $companyName = $companyMembership->getCompanyNameByUserId();
        return view('contact.contact', compact('companyName'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'category' => 'required|string|max:255',
            'detail' => 'required|string',
        ]);

        // DBへの保存
        $contactInputs = $request->all();
        Contact::create($contactInputs);

        // 問い合わせ通知メールの送信
        Mail::to($contactInputs['email'])->send(new ContactSendmail($contactInputs));
        Mail::to('yoshikawa.engineer@gmail.com')->send(new ContactSendmail($contactInputs));

        $request->session()->regenerateToken();

        $targetUrl = back()->getTargetUrl();

        // 送信後お問い合わせフォームが表示される
        if (str_ends_with($targetUrl, '/')) {
            return redirect($targetUrl . "#contact")->with('success', 'お問い合わせありがとうございます。ご回答まで数日ほどお待ちください。');
        } else if (str_ends_with($targetUrl, '/admin')) {
            return redirect($targetUrl . "#contact")->with('success', 'お問い合わせありがとうございます。ご回答まで数日ほどお待ちください。');
        } else {
            return back()->with('success', 'お問い合わせありがとうございます。ご回答まで数日ほどお待ちください。');
        }
    }
}
