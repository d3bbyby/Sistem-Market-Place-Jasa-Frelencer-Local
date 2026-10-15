<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JasaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FreelancerController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// ==================================================
// LANDING PAGE
// ==================================================

Route::get('/', function () {
    return view('landing');
})->name('home');


// ==================================================
// ROUTE BAWAAN LARAVEL
// ==================================================

require __DIR__ . '/auth.php';


// ==================================================
// LOGIN, REGISTER, LOGOUT
// ==================================================

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');


Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.submit');


Route::get('/logout', [AuthController::class, 'logout'])
    ->name('logout');


// ==================================================
// DASHBOARD REDIRECT
// ==================================================

Route::get('/dashboard', function () {
    $user = auth()->user();

    if (!$user) {
        return redirect('/login');
    }

    $role = strtolower(trim((string) $user->role));

    if (in_array($role, ['admin', 'administrator'])) {
        return redirect('/admin/dashboard');
    }

    if ($role === 'freelancer') {
        return redirect('/freelancer/dashboard');
    }

    if ($role === 'client') {
        return redirect('/client/dashboard');
    }

    abort(403, 'Role akun tidak dikenali.');
})->middleware('auth')->name('dashboard');


// ==================================================
// PROFIL BAWAAN LARAVEL
// ==================================================

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


// ==================================================
// CLIENT ROUTES
// ==================================================

// Dashboard Client

Route::get('/client/dashboard', function () {
    return view('client.dashboard');
})->name('client.dashboard');


// Cari Freelancer / Cari Jasa

Route::get('/client/jasa', function (Request $request) {
    $query = $request->input('q');

    $freelancers = User::where('role', 'freelancer')
        ->when($query, function ($q) use ($query) {
            $q->where(function ($data) use ($query) {
                $data->where('name', 'like', '%' . $query . '%')
                     ->orWhere('email', 'like', '%' . $query . '%');
            });
        })
        ->get();

    return view('client.jasa', compact('freelancers', 'query'));
})->name('client.jasa');


// Detail Jasa

Route::get('/client/detail-jasa', function () {
    return view('client.detail_jasa');
})->name('client.detail_jasa');


// Pesanan Saya

Route::get('/client/pesanan', function () {
    return view('client.pesanan');
})->name('client.pesanan');


// Profil dan Pengaturan Client

Route::get('/client/profil', function () {
    return view('client.profil');
})->name('client.profil');

Route::get('/client/pengaturan', function () {
    return view('client.profil');
})->name('client.pengaturan');


// Menyimpan perubahan nama dan email Client

Route::middleware('auth')->group(function () {
    $updateClientProfile = function (Request $request) {
        $user = $request->user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->save();

        return redirect('/client/profil')
            ->with('success', 'Profil berhasil diperbarui!');
    };

    Route::put('/client/profil', $updateClientProfile)
        ->name('client.profil.update');

    Route::put('/client/pengaturan', $updateClientProfile)
        ->name('client.pengaturan.update');
});


// ==================================================
// FREELANCER ROUTES
// ==================================================

// Dashboard Freelancer

Route::get('/freelancer/dashboard', function () {
    return view('freelancer.dashboard');
})->name('freelancer.dashboard');


// Profil Freelancer

Route::get('/freelancer/profil', function () {
    return view('freelancer.profil');
})->name('freelancer.profil');


// Pengaturan Freelancer

Route::get('/freelancer/pengaturan', function () {
    return view('freelancer.profil');
})->name('freelancer.pengaturan');


// Redirect ke CRUD Jasa yang sudah ada

Route::redirect('/freelancer/jasa', '/jasa')
    ->name('freelancer.jasa');

Route::redirect('/freelancer/portofolio', '/portfolios')
    ->name('freelancer.portofolio');

Route::redirect('/freelancer/kelola-jasa/tambah', '/jasa/create')
    ->name('freelancer.jasa.create');


// Pesanan Freelancer

Route::get('/freelancer/pesanan', function () {
    return view('freelancer.pesanan');
})->name('freelancer.pesanan');


// Halaman tambah jasa versi Blade

Route::get('/freelancer/jasa/tambah', function () {
    return view('freelancer.tambah_jasa');
})->name('freelancer.tambah_jasa');


// ==================================================
// ADMIN ROUTES
// ==================================================

// Dashboard Admin

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');


// Profil Admin

Route::get('/admin/profil', function () {
    return view('admin.profil');
})->name('admin.profil');


// ==================================================
// CRUD USER
// ==================================================

Route::resource('users', UserController::class);


// ==================================================
// CRUD KATEGORI
// ==================================================

Route::resource('categories', KategoriController::class)
    ->except('show');


// ==================================================
// CRUD JASA
// ==================================================

Route::resource('jasa', JasaController::class)
    ->except('show');


// ==================================================
// CRUD PORTOFOLIO
// ==================================================

Route::resource('portfolios', PortfolioController::class)
    ->except('show');


// ==================================================
// ADMIN - VERIFIKASI FREELANCER
// ==================================================

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/freelancers', [FreelancerController::class, 'index'])
            ->name('freelancers.index');

        Route::patch('/freelancers/{user}/verify', [FreelancerController::class, 'verify'])
            ->name('freelancers.verify');

        Route::patch('/freelancers/{user}/reject', [FreelancerController::class, 'reject'])
            ->name('freelancers.reject');
    });