<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;  
use App\Models\CompanyInfo;
use App\Models\ServiceApplied;


class DashboardController extends Controller
{
    public function index(){
         $company=CompanyInfo::first();
        return view('admin::dashboard.index',compact('company'));
    }
}
