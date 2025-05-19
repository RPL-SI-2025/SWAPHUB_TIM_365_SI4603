<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $barang = Barang::show_item();
        return view('home', compact('barang'));
    }
}