<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JasaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PortfolioController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// ==============================
// LANDING PAGE
// ==============================

Route::get('/', function () {
    return view('landing');
});

// ==============================
// LOGIN
// ==============================

Route::get('/login', function () {
    return view('login');
});

Route::post('/login', [AuthController::class, 'login']);

// ==============================
// REGISTER
// ==============================

Route::get('/register', function () {
    return view('register');
});

Route::post('/register', [AuthController::class, 'register']);

// ==============================
// LOGOUT
// ==============================

Route::get('/logout', [AuthController::class, 'logout']);

// ==============================
// DASHBOARD CLIENT
// ==============================

Route::get('/client/dashboard', function () {
    return view('client.dashboard');
});

// ==============================
// PROFIL CLIENT
// ==============================

Route::get('/client/pengaturan', function () {
    return view('client.profil');
});

// ==============================
// DASHBOARD FREELANCER
// ==============================

Route::get('/freelancer/dashboard', function () {
    return view('freelancer.dashboard');
});

// ==============================
// DASHBOARD ADMIN
// ==============================

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

// ==============================
// PROFIL FREELANCER
// ==============================

Route::get('/freelancer/profil', function () {
    return view('freelancer.profil');
});

// ==============================
// PENCARIAN FREELANCER / JASA
// ==============================

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
// PROFIL ADMIN
// ==============================

Route::get('/admin/profil', function () {
    return view('admin.profil');
});

Route::redirect('/freelancer/jasa', '/jasa')->name('freelancer.jasa');
Route::redirect('/freelancer/portofolio', '/portfolios')->name('freelancer.portofolio');
Route::redirect('/freelancer/kelola-jasa/tambah', '/jasa/create')->name('freelancer.jasa.create');

Route::resource('categories', KategoriController::class)->except('show');

Route::resource('jasa', JasaController::class)->except('show');

Route::resource('portfolios', PortfolioController::class)->except('show');
