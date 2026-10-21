<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    /**
     * Login pengguna.
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        if (!Auth::attempt($validated, $remember)) {
            return back()
                ->withInput($request->only('email'))
                ->with('error', 'Email atau password salah.');
        }

        // Memperbarui session setelah login.
        $request->session()->regenerate();

       \Illuminate\Support\Facades\Log::info('DEBUG LOGIN', [
    'authenticated' => Auth::check(),
    'user_id' => Auth::id(),
    'session_id' => $request->session()->getId(),
    'has_login_key' => collect(array_keys($request->session()->all()))
        ->contains(fn ($key) => str_starts_with($key, 'login_web_')),
]);
        $user = Auth::user();
        $role = strtolower(trim((string) $user->role));

        // Mengarahkan pengguna berdasarkan role.
        if (in_array($role, ['admin', 'administrator'], true)) {
            return redirect('/admin/dashboard');
        }

        if ($role === 'freelancer') {
            return redirect('/freelancer/dashboard');
        }

        if ($role === 'client') {
            return redirect('/client/dashboard');
        }

        // Logout jika role tidak dikenali.
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')
            ->with('error', 'Role akun tidak dikenali.');
    }

    /**
     * Register pengguna baru.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8),
            ],
            'role' => ['required', 'in:client,freelancer'],
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

    /**
     * Logout pengguna.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')
            ->with('success', 'Kamu berhasil logout.');
    }
}
