<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // ==============================
    // LOGIN
    // ==============================

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt(
            [
                'email' => $request->email,
                'password' => $request->password
            ],
            $request->has('remember')
        )) {

            $request->session()->regenerate();

            $role = Auth::user()->role;

            // ADMIN
            if ($role == 'admin') {
                return redirect('/admin/dashboard');
            }

            // FREELANCER
            if ($role == 'freelancer') {
                return redirect('/freelancer/dashboard');
            }

            // CLIENT
            return redirect('/client/dashboard');
        }

        return back()->with(
            'error',
            'Email atau password salah.'
        );
    }


    // ==============================
    // REGISTER
    // ==============================

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:client,freelancer'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect('/login')->with(
            'success',
            'Pendaftaran berhasil. Silakan login.'
        );
    }


    // ==============================
    // LOGOUT
    // ==============================

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}