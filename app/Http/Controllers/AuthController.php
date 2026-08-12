<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Support login using email or username
        $loginType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $authCredentials = [
            $loginType => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($authCredentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            activity()->log('User logged in');

            return redirect()->intended('/dashboard')->with('success', 'Berhasil login.');
        }

        return back()->withErrors([
            'username' => 'Email / Username atau password salah.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        activity()->log('User logged out');
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Berhasil logout.');
    }
}
