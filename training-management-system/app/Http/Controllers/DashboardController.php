<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Banner;

class DashboardController extends Controller
{
    public function index(){
        $totalUsers = user::count();
        $totalCompanies = company::count();
        $totalBanners = banner::count();

        return view('dashboard', compact('totalUsers', 'totalCompanies', 'totalBanners'));
    }
}
