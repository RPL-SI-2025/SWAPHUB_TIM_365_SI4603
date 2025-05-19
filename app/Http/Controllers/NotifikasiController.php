<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $notifications = Notifikasi::where('id_user', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('notifikasi.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $user = Auth::user();
        $notification = Notifikasi::where('id_user', $user->id)->findOrFail($id);

        $notification->is_read = true;
        $notification->save();

        return redirect()->back()->with('success', 'Notifikasi telah ditandai sebagai dibaca.');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $notification = Notifikasi::where('id_user', $user->id)->findOrFail($id);

        $notification->delete();

        return redirect()->back()->with('success', 'Notifikasi berhasil dihapus.');
    }

    public function markAllAsRead()
    {
        $user = Auth::user();
        Notifikasi::where('id_user', $user->id)->where('is_read', false)->update(['is_read' => true]);

        return redirect()->back()->with('success', 'Semua notifikasi telah ditandai sebagai dibaca.');
    }
}
