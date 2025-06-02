<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $totalUsers = User::where('role', '!=', 'admin')->count();
        $newUsersThisWeek = User::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();

        $users = User::where('role', '!=', 'admin')->get();
        return view('admin.dashboard.index', compact('totalUsers', 'newUsersThisWeek'));
    }
}
