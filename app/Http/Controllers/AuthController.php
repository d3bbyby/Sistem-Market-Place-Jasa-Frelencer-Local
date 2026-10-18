<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $remember = $request->boolean('remember');

        if (! Auth::attempt($validated, $remember)) {
            return back()
                ->withInput($request->only('email'))
                ->with('error', 'Email atau password salah.');
        }

        $request->session()->regenerate();

        $user = Auth::user();
        $role = strtolower(trim((string) $user->role));

        if ($role === 'admin' || $role === 'administrator') {
            return redirect('/admin/dashboard');
        }

        if ($role === 'freelancer') {
            return redirect('/freelancer/dashboard');
        }

        if ($role === 'client') {
            return redirect('/client/dashboard');
        }

        Auth::logout();

        return redirect('/login')
            ->with('error', 'Role akun tidak dikenali.');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:client,freelancer',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        if ($user->role === 'freelancer') {
            return redirect('/freelancer/dashboard');
        }

        return redirect('/client/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
