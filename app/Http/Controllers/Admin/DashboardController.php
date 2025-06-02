<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\RatingWebsite;
use App\Models\LaporanPenipuan;
use App\Models\Penukaran;
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

        $totalTrades = Penukaran::count();

        $todayTradesCount = Penukaran::whereDate('created_at', Carbon::now()->toDateString())->count();

        $successfulTrades = Penukaran::where('status_penukaran', 'diterima')->count();
        $tradeSuccessRate = $totalTrades > 0 ? round(($successfulTrades / $totalTrades) * 100, 2) : 0;

        $averageRating = round(RatingWebsite::average('rating'), 2);

        $totalReports = LaporanPenipuan::count();
        $pendingReports = LaporanPenipuan::where('status_laporan', 'pending')->count();
        $acceptReports = LaporanPenipuan::where('status_laporan', 'diterima')->count();
        $rejectReports = LaporanPenipuan::where('status_laporan', 'ditolak')->count();


        return view('admin.dashboard.index', compact(
            'totalUsers',
            'newUsersThisWeek',
            'totalTrades',
            'todayTradesCount',
            'successfulTrades',
            'tradeSuccessRate',
            'averageRating',
            'totalReports',
            'pendingReports',
            'acceptReports',
            'rejectReports'
        ));
    }
}
