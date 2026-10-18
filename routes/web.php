<?php

use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JasaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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
})->name('login');

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

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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
        ->with(['services.category'])
        ->whereHas('services')
        ->when($query, function ($q) use ($query) {
            $q->where(function ($data) use ($query) {
                $data->where('name', 'like', '%'.$query.'%')
                    ->orWhere('email', 'like', '%'.$query.'%')
                    ->orWhereHas('services', function ($services) use ($query) {
                        $services->where('title', 'like', '%'.$query.'%')
                            ->orWhereHas('category', function ($categories) use ($query) {
                                $categories->where('category_name', 'like', '%'.$query.'%');
                            });
                    });
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

Route::middleware('auth')->group(function () {
    Route::get('/client/pesanan', [OrderController::class, 'clientIndex'])
        ->name('client.orders.index');
    Route::get('/client/jasa/{service}', [OrderController::class, 'showService'])
        ->name('client.orders.service');
    Route::post('/client/jasa/{service}/pesan', [OrderController::class, 'store'])
        ->name('client.orders.store');
    Route::patch('/client/orders/{order}/status', [OrderController::class, 'updateStatus'])
        ->name('client.orders.updateStatus');

    Route::get('/freelancer/pesanan', [OrderController::class, 'freelancerIndex'])
        ->name('freelancer.orders.index');
    Route::patch('/freelancer/orders/{order}/status', [OrderController::class, 'updateStatus'])
        ->name('freelancer.orders.updateStatus');
    Route::get('/orders/{order}/deliverable', [OrderController::class, 'downloadDeliverable'])
        ->name('orders.deliverable');

    Route::get('/admin/orders', [OrderController::class, 'adminIndex'])
        ->name('admin.orders.index');
    Route::patch('/admin/orders/{order}/status', [OrderController::class, 'adminUpdateStatus'])
        ->name('admin.orders.updateStatus');
    Route::get('/admin/freelancers', [OrderController::class, 'freelancers'])
        ->name('admin.freelancers.index');
    Route::patch('/admin/freelancers/{user}/verification', [OrderController::class, 'updateFreelancerVerification'])
        ->name('admin.freelancers.updateVerification');
});

Route::redirect('/freelancer/jasa', '/jasa')->name('freelancer.jasa');
Route::redirect('/freelancer/portofolio', '/portfolios')->name('freelancer.portofolio');
Route::redirect('/freelancer/kelola-jasa/tambah', '/jasa/create')->name('freelancer.jasa.create');

Route::resource('categories', KategoriController::class)->except('show');
Route::resource('jasa', JasaController::class)->except('show');
Route::resource('portfolios', PortfolioController::class)->except('show');
Route::resource('users', UserController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');
});
