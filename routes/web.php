<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LeadController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/leads', [LeadController::class, 'store'])->name('leads.store');

// Auth
Route::get('/admin/login',  [LoginController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

// Admin — protégé
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/',                            [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/export',                      [AdminController::class, 'export'])->name('admin.export');
    Route::patch('/leads/{lead}/status',       [AdminController::class, 'updateStatus'])->name('admin.leads.status');
});
