<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $barang = Barang::where('id_user', '!=', Auth::id())->get();
        return view('home', compact('barang'));
    }
}
