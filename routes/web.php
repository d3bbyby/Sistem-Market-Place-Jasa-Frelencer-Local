<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


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