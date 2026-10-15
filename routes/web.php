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
});


// ==================================================
// AUTHENTICATION
// ==================================================

// Pertahankan route bawaan Laravel untuk fitur autentikasi lain.
require __DIR__ . '/auth.php';

// Gunakan halaman login dan register milik proyek.
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout']);


// ==================================================
// DASHBOARD REDIRECT SETELAH LOGIN
// ==================================================

Route::get('/dashboard', function () {
    $user = auth()->user();
    $role = strtolower(trim((string) ($user->role ?? '')));

    if (in_array($role, ['admin', 'administrator'])) {
        return redirect('/admin/dashboard');
    }

    if ($role === 'freelancer') {
        return redirect('/freelancer/dashboard');
    }

    // Client merupakan tujuan default jika role bukan admin
    // atau freelancer.
    return redirect('/client/dashboard');

})->middleware('auth')->name('dashboard');


// ==================================================
// PROFIL LARAVEL
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


// Cari Freelancer
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
Route::view('/client/detail-jasa', 'client.detail_jasa')
    ->name('client.detail_jasa');


// Pesanan Saya
Route::view('/client/pesanan', 'client.pesanan')
    ->name('client.pesanan');


// Profil dan Pengaturan Akun Client
Route::middleware('auth')->group(function () {
    Route::get('/client/profil', function () {
        return view('client.profil');
    })->name('client.profil');

    Route::get('/client/pengaturan', function () {
        return view('client.profil');
    })->name('client.pengaturan');

    // Menyimpan perubahan nama dan email.
    $updateClientProfile = function (Request $request) {
        $user = $request->user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->save();

        return redirect('/client/pengaturan')
            ->with('success', 'Profil berhasil diperbarui!');
    };

    Route::put('/client/pengaturan', $updateClientProfile)
        ->name('client.pengaturan.update');

    // Mendukung form profil lama.
    Route::put('/client/profil', $updateClientProfile)
        ->name('client.profil.update');
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

// Alias pengaturan ke halaman profil yang tersedia.
Route::get('/freelancer/pengaturan', function () {
    return view('freelancer.profil');
})->name('freelancer.pengaturan');


// Kelola Jasa
Route::get('/freelancer/jasa', function () {
    return view('freelancer.kelola_jasa');
})->name('freelancer.jasa');


// Tambah Jasa
Route::get('/freelancer/jasa/tambah', function () {
    return view('freelancer.tambah_jasa');
})->name('freelancer.jasa.create');

// Alias untuk alamat lama.
Route::redirect(
    '/freelancer/kelola-jasa/tambah',
    '/freelancer/jasa/tambah'
);


// Pesanan Freelancer
Route::view('/freelancer/pesanan', 'freelancer.pesanan')
    ->name('freelancer.pesanan');


// Portofolio Freelancer
Route::view('/freelancer/portofolio', 'freelancer.portofolio')
    ->name('freelancer.portofolio');


// ==================================================
// ADMIN ROUTES
// ==================================================

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/admin/profil', function () {
    return view('admin.profil');
})->name('admin.profil');


// ==================================================
// CRUD USER
// PERTAHANKAN CONTROLLER TEMANMU
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