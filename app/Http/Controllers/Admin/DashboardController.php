<?php

namespace App\Http\Controllers\Admin;

use App\Models\User\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $active = User::where('status', 'ACTIVE')->count();
        $inactive = User::where('status', 'INACTIVE')->count();
        $verified = User::where('verification', '1')->count();
        return view('admin.dashboard.dashboard', compact('active','inactive','verified'));
    }
}
