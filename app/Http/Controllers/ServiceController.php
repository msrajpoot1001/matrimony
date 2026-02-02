<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MatchMaking;
use App\Models\CompanyInfo;
 
class ServiceController extends Controller
{
    public function matchMaking(){
         $company=CompanyInfo::first();
        $profiles=MatchMaking::latest()->paginate(10);
        return view("website.pages.services.matchmaking",compact('profiles','company'));
    }
}
