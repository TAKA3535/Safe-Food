<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/main', function () {
    return view('main');
})->middleware(['auth', 'verified'])->name('main');

Route::post('/main', function () {
    return view('main');
})->middleware(['auth', 'verified'])->name('main');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/tabs', function () {
    return view('tabs');
});

Route::get('foods/create', function () {
    return view('foods/create');
})->middleware(['auth', 'verified']);

Route::get('foods/update', function () {
    return view('foods/update');
})->middleware(['auth', 'verified']);

Route::get('auth/confirm-password', function () {
    return view('auth/confirm-password');
});

Route::get('auth/reset-password', function () {
    return view('auth/reset-password');
});

Route::get('auth/verify-email', function () {
    return view('auth/verify-email');
});

Route::get('line', function () {
    return view('line');
})->middleware(['auth', 'verified']);

require __DIR__ . '/auth.php';
