<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')
    ->name('/');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::livewire('articles', 'pages::articles.list')
    ->name('articles.index');

require __DIR__.'/auth.php';
