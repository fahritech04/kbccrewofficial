<?php

use App\Http\Controllers\ClubsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstagramController;
use App\Http\Controllers\MatchesController;
use App\Http\Controllers\PlayersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/matches', [MatchesController::class, 'index'])->name('matches.index');
Route::get('/table', [TableController::class, 'index'])->name('table.index');
Route::get('/players', [PlayersController::class, 'index'])->name('players.index');
Route::get('/clubs', [ClubsController::class, 'index'])->name('clubs.index');
Route::get('/instagram', [InstagramController::class, 'index'])->name('instagram.index');
Route::get('/instagram/media', [InstagramController::class, 'media'])->name('instagram.media');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
