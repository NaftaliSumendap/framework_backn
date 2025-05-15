<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authentication extends Controller
{ 
    function login() {
        return view('sign-in');
    }
    public function autentikasi(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        return redirect()->intended('index');
    }

    return back()->withErrors([
        // 'email' => 'The provided credentials do not match our records.',
      'login' => 'Email atau Password yang anda masukan adalah salah',
    ])->onlyInput('email');
}

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/index_guest');
    }   
}
