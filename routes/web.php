<?php

use App\Http\Controllers\BlockController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PageController;
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

// TEST
Route::get('/', [MainController::class,'index'])->name('home');
Route::get('/reverse', [MainController::class,'reverse']);

// Pages
Route::get('/{page:slug}', [PageController::class, 'show'])->name('pages.show');

// Get blocks
Route::get('/get-blocks/{page:slug}', [BlockController::class, 'getBlocks'])->name('blocks.get-blocks');


// ADMIN
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/admin', [MainController::class, 'admin'])->name('admin');
});


// Jetstream
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
