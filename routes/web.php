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

// ==============================
// LANDING PAGE & DASHBOARD
// ==============================

Route::get('/', function () {
    return view('landing');
});


Route::get('/dashboard', function () {
    $role = auth()->user()->role;

    if ($role === 'client') {
        return redirect('/client/dashboard');
    }

    if ($role === 'freelancer') {
        return redirect('/freelancer/dashboard');
    }

    if ($role === 'admin') {
        return redirect('/admin/dashboard');
    }

    abort(403);
})->middleware('auth')->name('dashboard');

// ==============================
// AUTHENTICATION
// ==============================

Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', function () {
    return view('register');
});
Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout']);

// Breeze / Laravel Default Auth Routes
require __DIR__.'/auth.php';

// ==============================
// USER & PROFILE MANAGEMENT
// ==============================

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('users', UserController::class);

// ==============================
// CLIENT ROUTES
// ==============================

Route::get('/client/dashboard', function () {
    return view('client.dashboard');
});

Route::get('/client/pengaturan', function () {
    return view('client.profil');
});

Route::get('/client/jasa', function (Request $request) {
    $query = $request->input('q');

    $freelancers = User::where('role', 'freelancer')
        ->when($query, function ($q) use ($query) {
            $q->where(function ($data) use ($query) {
                $data->where('name', 'like', '%'.$query.'%')
                    ->orWhere('email', 'like', '%'.$query.'%');
            });
        })
        ->get();

    return view('client.jasa', compact('freelancers', 'query'));
});

// ==============================
// FREELANCER ROUTES
// ==============================

Route::get('/freelancer/dashboard', function () {
    return view('freelancer.dashboard');
});

Route::get('/freelancer/profil', function () {
    return view('freelancer.profil');
});

Route::redirect('/freelancer/jasa', '/jasa')->name('freelancer.jasa');
Route::redirect('/freelancer/portofolio', '/portfolios')->name('freelancer.portofolio');
Route::redirect('/freelancer/kelola-jasa/tambah', '/jasa/create')->name('freelancer.jasa.create');

// ==============================
// ADMIN ROUTES
// ==============================

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/admin/profil', function () {
    return view('admin.profil');
});

// ==============================
// RESOURCES (CRUD)
// ==============================

Route::resource('categories', KategoriController::class)->except('show');
Route::resource('jasa', JasaController::class)->except('show');
Route::resource('portfolios', PortfolioController::class)->except('show');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/freelancers', [FreelancerController::class, 'index'])
        ->name('freelancers.index');

    Route::patch('/freelancers/{user}/verify', [FreelancerController::class, 'verify'])
        ->name('freelancers.verify');

    Route::patch('/freelancers/{user}/reject', [FreelancerController::class, 'reject'])
        ->name('freelancers.reject');
});
