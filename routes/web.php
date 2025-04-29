<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Dashboard;
use Livewire\Volt\Volt;

Route::view('/', 'welcome');


// Route::get('/dashboard', Volt::route('dashboard'))->middleware(['auth'])->name('dashboard');
// Volt:route('dashboard', 'pages.dashboard')->name('dashboard');
// Route::get('/easypay/success', [EasyPayController::class, 'success'])->name('easypay.success');
Route::view('dashboard',  'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
