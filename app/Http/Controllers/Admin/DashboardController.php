<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $totalUsers = User::count();


        $revenue = 34900;
        $orders = 278;

        return view('admin.dashboard', compact('totalUsers', 'revenue', 'orders'));
    }
}
