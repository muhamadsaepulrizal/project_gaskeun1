<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|unique:users,email|unique:users,username',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->email, // Menggunakan email sebagai username
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('Publik');

        Auth::login($user);

        activity()->performedOn($user)->log('User registered via public registration');

        return redirect('/dashboard')->with('success', 'Registrasi berhasil! Selamat datang.');
    }
}
