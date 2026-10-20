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

Route::get('posts/trash', [ProjectController::class, 'trash'])->name('posts.trash');
Route::patch('posts/{project}/restore', [ProjectController::class, 'restore'])->name('posts.restore');
Route::delete('posts/{project}/force-delete', [ProjectController::class, 'permanentlyDelete'])
    ->name('posts.force-delete');

Route::resource('posts', ProjectController::class)->parameters([
    'posts' => 'project',
]);
