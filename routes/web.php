<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminLaporanController;
use App\Http\Controllers\AdminReviewController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientDashboardController;
use App\Http\Controllers\ClientPaymentController;
use App\Http\Controllers\ClientReviewController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FreelancerDashboardController;
use App\Http\Controllers\JasaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\PortfolioRatingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceRequestApplicationController;
use App\Http\Controllers\ServiceRequestController;
use App\Http\Controllers\UserController;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// ==============================
// LANDING PAGE
// ==============================

Route::get('/', function () {
    $serviceRequests = ServiceRequest::with('client')
        ->where('status', 'open')
        ->latest()
        ->take(6)
        ->get();

    return view('landing', compact('serviceRequests'));
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

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

// ==============================
// POSTING KEBUTUHAN JASA CLIENT
// ==============================

Route::middleware(['auth', 'role:client'])->group(function () {

    Route::get('/client/service-requests', [ServiceRequestController::class, 'index'])
        ->name('client.service-requests.index');

    Route::get('/client/service-requests/create', [ServiceRequestController::class, 'create'])
        ->name('client.service-requests.create');

    Route::post('/client/service-requests', [ServiceRequestController::class, 'store'])
        ->name('client.service-requests.store');

    Route::delete('/client/service-requests/{serviceRequest}', [ServiceRequestController::class, 'destroy'])
        ->name('client.service-requests.destroy');

    Route::get('/client/service-requests/{serviceRequest}/applications', [ServiceRequestApplicationController::class, 'index'])
        ->name('client.service-requests.applications');

    Route::post('/client/service-requests/{serviceRequest}/applications/{application}/select', [ServiceRequestApplicationController::class, 'select'])
        ->name('client.service-requests.select');
});

// ==============================
// APPLY FREELANCER
// ==============================

Route::middleware(['auth', 'role:freelancer'])->group(function () {

    // Menampilkan posting kebutuhan jasa
    Route::get('/freelancer/service-requests', [ServiceRequestController::class, 'freelancerIndex'])
        ->name('freelancer.service-requests.index');

    // Mengajukan diri pada posting
    Route::post('/freelancer/service-requests/{serviceRequest}/apply', [ServiceRequestApplicationController::class, 'store'])
        ->name('freelancer.service-requests.apply');

});
// ==============================
// DASHBOARD CLIENT
// ==============================

Route::get('/client/dashboard', ClientDashboardController::class)
    ->middleware(['auth', 'role:client'])
    ->name('client.dashboard');

// ==============================
// REVIEW CLIENT
// ==============================

Route::post('/client/orders/{order}/review', [ClientReviewController::class, 'store'])
    ->middleware(['auth', 'role:client'])
    ->name('client.reviews.store');

Route::get('/client/review', [ClientReviewController::class, 'index'])
    ->middleware(['auth', 'role:client'])
    ->name('client.review');

// ==============================
// PEMBAYARAN CLIENT
// ==============================

Route::get('/client/pembayaran', [ClientPaymentController::class, 'index'])
    ->middleware(['auth', 'role:client'])
    ->name('client.pembayaran');

// ==============================
// PROFIL CLIENT
// ==============================

Route::middleware(['auth', 'role:client'])->group(function () {

    Route::get('/client/pengaturan', function () {
        return view('client.profile');
    })->name('client.profile');

    Route::patch('/client/pengaturan', [ProfileController::class, 'update'])
        ->name('client.profile.update');

    Route::delete('/client/pengaturan/foto', [ProfileController::class, 'deletePhoto'])
        ->name('client.profile.deletePhoto');

});

// ==============================
// FAVORIT CLIENT
// ==============================

Route::middleware(['auth', 'role:client'])->group(function () {

    Route::get('/client/favorit', [FavoriteController::class, 'index'])
        ->name('client.favorit');

    Route::post('/client/favorit/jasa', [FavoriteController::class, 'storeService'])
        ->name('client.favorit.jasa');

    Route::post('/client/favorit/freelancer', [FavoriteController::class, 'storeFreelancer'])
        ->name('client.favorit.freelancer');

    Route::delete('/client/favorit/{favorite}', [FavoriteController::class, 'destroy'])
        ->name('client.favorit.destroy');

});

// ==============================
// DASHBOARD FREELANCER
// ==============================

Route::get('/freelancer/dashboard', FreelancerDashboardController::class)
    ->middleware(['auth', 'role:freelancer'])
    ->name('freelancer.dashboard');

Route::get('/freelancer/pendapatan', [FreelancerDashboardController::class, 'income'])
    ->middleware(['auth', 'role:freelancer'])
    ->name('freelancer.pendapatan');

// ==============================
// PROFIL FREELANCER
// ==============================

Route::middleware(['auth', 'role:freelancer'])->group(function () {

    Route::get('/freelancer/profil', function () {
        return view('freelancer.profil');
    })->name('freelancer.profil');

    Route::delete('/freelancer/profil/foto', [ProfileController::class, 'deletePhoto'])
        ->name('freelancer.profile.deletePhoto');

    Route::patch('/freelancer/profil', [ProfileController::class, 'update'])
        ->name('freelancer.profile.update');
});

// ==============================
// DASHBOARD ADMIN
// ==============================

Route::get('/admin/dashboard', AdminDashboardController::class)
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');

Route::get('/admin/jasa', [JasaController::class, 'adminIndex'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.jasa.index');

Route::get('/admin/kategori', [KategoriController::class, 'adminIndex'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.categories.index');

Route::get('/admin/subkategori', [KategoriController::class, 'adminSubcategories'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.subcategories.index');

// ==============================
// PROFIL ADMIN
// ==============================

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/profil', function () {
        return view('admin.profil');
    })->name('admin.profil');

    Route::patch('/admin/profil', [ProfileController::class, 'update'])
        ->name('admin.profile.update');

    Route::delete('/admin/profil/foto', [ProfileController::class, 'deletePhoto'])
        ->name('admin.profile.deletePhoto');

});

// ==============================
// REVIEW ADMIN
// ==============================

Route::get('/admin/review', [AdminReviewController::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.review');

// ==============================
// LAPORAN ADMIN
// ==============================

Route::get('/admin/laporan', [AdminLaporanController::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.laporan');

// ==============================
// PENCARIAN FREELANCER / JASA
// ==============================

Route::get('/client/jasa', [JasaController::class, 'browse'])
    ->name('client.jasa');

// ==============================
// ROUTE PESANAN
// ==============================

Route::middleware('auth')->group(function () {

    // Pesanan Client
    Route::get('/client/pesanan', [OrderController::class, 'clientIndex'])
        ->name('client.orders.index');

    Route::get('/client/jasa/{service}', [JasaController::class, 'show'])
        ->middleware('role:client')
        ->name('client.orders.service');

    Route::post('/client/jasa/{service}/pesan', [OrderController::class, 'store'])
        ->name('client.orders.store');

    Route::patch('/client/orders/{order}/status', [OrderController::class, 'updateStatus'])
        ->name('client.orders.updateStatus');

    // Pesanan Freelancer
    Route::get('/freelancer/pesanan', [OrderController::class, 'freelancerIndex'])
        ->name('freelancer.orders.index');

    Route::patch('/freelancer/orders/{order}/status', [OrderController::class, 'updateStatus'])
        ->name('freelancer.orders.updateStatus');

    Route::get('/orders/{order}/deliverable', [OrderController::class, 'downloadDeliverable'])
        ->name('orders.deliverable');

    // Pesanan Admin
    Route::get('/admin/orders', [OrderController::class, 'adminIndex'])
        ->middleware('role:admin')
        ->name('admin.orders.index');

    Route::patch('/admin/orders/{order}/status', [OrderController::class, 'adminUpdateStatus'])
        ->middleware('role:admin')
        ->name('admin.orders.updateStatus');

    // Freelancer Admin
    Route::get('/admin/freelancers', [OrderController::class, 'freelancers'])
        ->middleware('role:admin')
        ->name('admin.freelancers.index');

    Route::patch('/admin/freelancers/{user}/verification', [OrderController::class, 'updateFreelancerVerification'])
        ->middleware('role:admin')
        ->name('admin.freelancers.updateVerification');

});

// ==============================
// REDIRECT FREELANCER
// ==============================

Route::redirect('/freelancer/jasa', '/jasa')
    ->name('freelancer.jasa');

Route::redirect('/freelancer/portofolio', '/portfolios')
    ->name('freelancer.portofolio');

Route::redirect('/freelancer/proyek', '/portfolios')
    ->name('freelancer.proyek');

Route::redirect('/freelancer/kelola-jasa/tambah', '/jasa/create')
    ->name('freelancer.jasa.create');

// ==============================
// KATEGORI DAN JASA
// ==============================

Route::get('/kategori/{category:slug}', [JasaController::class, 'category'])
    ->name('categories.services');

Route::resource('categories', KategoriController::class)
    ->except('show')
    ->middleware('auth');

Route::resource('jasa', JasaController::class)
    ->except('show')
    ->middleware('auth');

// ==============================
// PORTOFOLIO
// ==============================

Route::post('/portfolios/{portfolio}/ratings', [PortfolioRatingController::class, 'store'])
    ->middleware('auth')
    ->name('portfolios.ratings.store');

Route::resource('portfolios', PortfolioController::class)
    ->except('show')
    ->middleware('auth');

// ==============================
// DETAIL JASA DAN USER
// ==============================

Route::get('/jasa/{service}', [JasaController::class, 'show'])
    ->name('jasa.show');

Route::resource('users', UserController::class);

// ==============================
// DASHBOARD UMUM
// ==============================

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])
    ->name('dashboard');

// ==============================
// PROFIL UMUM DAN PASSWORD
// ==============================

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::put('/password', [PasswordController::class, 'update'])
        ->name('password.update');

});

// ==============================
// DEBUG SEMENTARA
// ==============================

Route::get('/debug-login', function (Request $request) {
    return response()->json([
        'authenticated' => auth()->check(),
        'user_id' => auth()->id(),
        'role' => auth()->user()?->role,
        'session_id' => $request->session()->getId(),
        'has_login_key' => collect(array_keys($request->session()->all()))
            ->contains(fn ($key) => str_starts_with($key, 'login_web_')),
        'has_cookie' => $request->hasCookie(config('session.cookie')),
    ]);
});
