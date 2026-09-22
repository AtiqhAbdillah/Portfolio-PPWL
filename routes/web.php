<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('home');
});

// routes/web.php
Route::get('/', fn () => view('home'))->name('home');
Route::get('/about', fn () => view('about'))->name('about');
Route::get('/education', fn () => view('education'))->name('education');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects');

Route::resource('posts', ProjectController::class)->parameters([
    'posts' => 'project',
]);
