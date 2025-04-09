<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function clearSession(Request $request)
    {
        $request->session()->forget('updateProfile');
        return redirect('/home');
    }
}
