<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')
    ->name('/');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::view('profile', 'profile')->name('profile');
    Route::livewire('articles/new', 'pages::articles.new')->name('articles.new');
});

Route::livewire('articles', 'pages::articles.list')
    ->name('articles.index');
Route::livewire('articles/{article:id}', 'pages::articles.show')
    ->name('articles.show');

require __DIR__.'/auth.php';
