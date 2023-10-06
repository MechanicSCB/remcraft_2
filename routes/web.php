<?php

use App\Http\Controllers\BlockController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\GalleryController;
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


// ADMIN
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/admin', [MainController::class, 'admin'])->name('admin');

    Route::post('/upload/{gallery}', [GalleryController::class, 'upload'])->name('galleries.upload');
    Route::post('/resize/{gallery}', [GalleryController::class, 'resize'])->name('galleries.resize');

    Route::resources([
        'pages' => PageController::class,
        'galleries' => GalleryController::class,
        'components' => ComponentController::class,
        'blocks' => BlockController::class,
    ]);
});

// Pages
Route::get('/{page:slug}', [PageController::class, 'show'])->name('pages.show');

// Get blocks ajax request
Route::get('/get-blocks/{page:slug}', [BlockController::class, 'getBlocks'])->name('blocks.get-blocks');

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
