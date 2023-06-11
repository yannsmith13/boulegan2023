<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\MigrationController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

////////////////////////////////////////////

Route::get('/', [PlayerController::class, "registration"])->name('players.registration');
Route::get('/ranking', [PlayerController::class, 'ranking'])->name('players.ranking');

Route::get('/generate-teams/{tours}', [TeamController::class, 'generateTeam'])->name('teams.generateTeam');
Route::get('/generate-semi/', [TeamController::class, 'generateSemiFinals'])->name('teams.generateSemiFinals');

Route::get('tour/{tour}', [GameController::class, 'displayTour'])->name('games.displayTour');

Route::get('/migrate-fresh', [MigrationController::class, "migrate"])->name('migrate');

require __DIR__.'/auth.php';
