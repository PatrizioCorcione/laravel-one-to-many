<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\PageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TechnoController;
use App\Http\Controllers\TypeController;
use App\Models\Project;

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

Route::get('/', [PageController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // inserire tutte le root protette da author
        Route::get('/', [DashboardController::class, 'index'])->name('home');
        Route::resource('project', ProjectController::class);
        Route::resource('technologies', TechnoController::class)->except([
            'create', 'show', 'edit'
        ]);
        Route::resource('types', TypeController::class)->except([
            'create', 'show', 'edit', 'index'
        ]);
        Route::get('orderby/{direction}/{column}', [ProjectController::class, 'orderby'])->name('orderby');
    });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
