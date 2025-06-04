<?php

namespace App\Http\Controllers;

use App\Models\User;
// use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Laravel\Socialite\Facades\Socialite;


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

        return redirect()->intended('/');
    }

    return back()->withErrors([
        // 'email' => 'The provided credentials do not match our records.',
      'login' => 'Email atau Password yang anda masukan adalah salah',
    ])->onlyInput('email');
}

    function register() {
        return view('sign-up');
    }

    public function createuser(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:4'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string','min:4'],
        ],[
            'name.required' => 'Kolom Nama Harus Di Isi!',
            'name.min' => 'Nama minimal harus 4 karakter',
            'email.required' => 'Kolom Email Harus Di Isi!',
            'email.email' => 'Format emailnya tidak valid',
            'email.unique' => 'Email sudah terdaftar, coba yang lain.',
            'password.required' => 'Password Tidak Boleh Kosong',
            'password.min' => 'Password minimal 8 karakter',
        ]);
    
        User::create($validated);
    
        return redirect()->route('register')->with('success', 'Registrasi berhasil!');

        event(new Registered($user));
    }

    public function google_redirect() {
        return Socialite::driver('google')->redirect();
    }

    public function google_callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
    
            // Cari user berdasarkan email
            $user = User::where('email', $googleUser->getEmail())->first();
    
            if (!$user) {
                // Buat user baru, Laravel 12 otomatis hashing password
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => uniqid(),  // Laravel akan hash otomatis karena 'password' cast ke 'hashed'
                ]);
            }
    
            Auth::login($user);
    
            return redirect()->intended('/');
        } catch (\Exception $e) {
            return redirect('/sign-in')->with('error', 'Login dengan Google gagal.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/index_guest');
    }   
}
