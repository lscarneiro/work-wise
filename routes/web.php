<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobPostController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\EnsureAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    //redirect to dashboard if user is logged in
    return auth()->check() ? redirect()->route('dashboard') : view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->middleware(['auth', EnsureAdmin::class])->name('admin.')->group(function () {
    Route::resource('companies', CompanyController::class)->except(['create', 'edit']);

    Route::patch('job-posts/{job_post}/publish', [JobPostController::class, 'publish'])->name('job-posts.publish');
    Route::patch('job-posts/{job_post}/unpublish', [JobPostController::class, 'unpublish'])->name('job-posts.unpublish');
    Route::resource('job-posts', JobPostController::class)->except(['create', 'edit']);
});

require __DIR__ . '/auth.php';
