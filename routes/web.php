<?php

use App\Http\Controllers\TrackController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\HomeController;


Route::get('/', [TrackController::class, 'index'])->name('tracks.index');

Route::post('/tracks', [TrackController::class, 'store'])->name('tracks.store');

Route::get('/tracks/create', [TrackController::class, 'create'])->name('tracks.create');

Route::get('/tracks/{track}/edit', [TrackController::class, 'edit'])->name('tracks.edit');

Route::put('/tracks/{track}', [TrackController::class, 'update'])->name('tracks.update');

Route::delete('/tracks/{track}', [TrackController::class, 'destroy'])->name('tracks.destroy');

Route::get('/user', [HomeController::class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});


