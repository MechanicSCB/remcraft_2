<?php

use App\Http\Controllers\BlockController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\NodeController;
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
Route::get('/test', [MainController::class,'test']);


// ADMIN
Route::middleware('auth')->group(function () {
    Route::get('/admin', [MainController::class, 'admin'])->name('admin');

    // Admin Images
    Route::post('/upload/{gallery}', [ImageController::class, 'upload'])->name('images.upload');
    Route::post('/sync/{gallery}', [ImageController::class, 'sync'])->name('images.sync');
    Route::delete('/delete/{image}', [ImageController::class, 'destroy'])->name('images.destroy');
    Route::post('/reorder-image/{image}/{order}', [ImageController::class, 'reorder'])->name('images.reorder');

    // Admin Menu Items
    Route::post('/nodes/reorder/{target_node}/to/{dest_node}', [NodeController::class, 'reorder'])->name('nodes.reorder');
    Route::post('/nodes/move/{target_node}/to/{dest_node}', [NodeController::class, 'move'])->name('nodes.move');


    // Admin Blocks
    Route::post('/reorder-block/{block}/{order}', [BlockController::class, 'reorder'])->name('blocks.reorder');

    Route::resources([
        'pages' => PageController::class,
        'galleries' => GalleryController::class,
        'components' => ComponentController::class,
        'blocks' => BlockController::class,
        'items' => ItemController::class,
        'nodes' => NodeController::class,
    ]);
});

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


// Pages
Route::get('/{page:slug}', [PageController::class, 'show'])->name('pages.show');
