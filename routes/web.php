<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// メール
use Illuminate\Support\Facades\Mail;
use App\Mail\AlertMail;

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

Route::get('create', function () {
    return view('create');
})->middleware(['auth', 'verified']);

Route::get('test2', function () {
    return view('test2');
})->middleware(['auth', 'verified']);

require __DIR__ . '/auth.php';



Route::get('/send-email', function () {
    // $to_email = 't.m.guestmail@gmail.com';
    $to_email = Auth::user();
    // $to_email = Auth::email();
    Mail::to($to_email)->send(new AlertMail());
    // return 'Send mailing' . $to_email;
    return 'send-email OK';
})->middleware('auth');



// use Illuminate\Support\Facades\Mail;
// use App\Mail\AlertMail;

// Route::get('/send-email', function () {
//     $to_email = Auth::user();
//     Mail::to($to_email)->send(new AlertMail());
//     return $to_email;
// })->middleware(['auth', 'verified']);