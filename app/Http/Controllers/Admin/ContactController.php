<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('admin.contact');
    }
}
