<?php

use App\Http\Controllers\FoodController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// メール
use Illuminate\Support\Facades\Mail;
use App\Mail\AlertMail;
// LINE
use App\Http\Controllers\LineController;

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


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () {
        return view('auth/login');
    });

    Route::get('/foods/{id}/test-name', [FoodController::class, 'testShow'])->name('foods.test-name.show');
    Route::get('/foods/{id}/form', [FoodController::class, 'form'])->name('foods.form');
    Route::post('/foods/{id}/form', [FoodController::class, 'application'])->name('foods.application');
    Route::get('/foods/{id}/completion', [FoodController::class, 'completion'])->name('foods.completion');


    Route::get('/main', 'App\Http\Controllers\FoodController@show')->name('foods.main');
    Route::post('/main', 'App\Http\Controllers\FoodController@create');

    Route::get('foods/create', function () {
        return view('foods/create');
    });

    Route::get('/foods/update/{id}', 'App\Http\Controllers\FoodController@foodUpdate');
    Route::post('/foods/update/{id}', 'App\Http\Controllers\FoodController@update');
    Route::post('/foods/delete/{id}', 'App\Http\Controllers\FoodController@delete');

    Route::get('auth/confirm-password', function () {
        return view('auth/confirm-password');
    });

    Route::get('auth/reset-password', function () {
        return view('auth/reset-password');
    });

    Route::get('auth/verify-email', function () {
        return view('auth/verify-email');
    });

    Route::get('line', [LineController::class, 'delete']);
    Route::post('line', [LineController::class, 'create']);
    Route::delete('line', [LineController::class, 'destroy']);
    Route::put('line', [LineController::class, 'update']);

    Route::get('create', function () {
        return view('create');
    });

    Route::get('test2', function () {
        return view('test2');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::get('/send-email', function () {
        $to_email = Auth::user();
        Mail::to($to_email)->send(new AlertMail());
        return 'send-email OK';
    });

    Route::get('/tabs', function () {
        return view('tabs');
    });
});

require __DIR__ . '/auth.php';

// Route::get('/', function () {
//     return view('auth/login');
// });

// // Route::get('/main', function () {
// //     return view('main');
// // })->middleware(['auth', 'verified'])->name('main');

// Route::get('/main', 'App\Http\Controllers\FoodController@show')->middleware(['auth', 'verified']);
// Route::post('/main', 'App\Http\Controllers\FoodController@create')->middleware(['auth', 'verified']);

// // Route::put('/main/{{$data->id}}', 'App\Http\Controllers\FoodController@update')->middleware(['auth', 'verified']);

// // Route::post('/main', function () {
// //     return view('main');
// // })->middleware(['auth', 'verified'])->name('main');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// Route::get('/tabs', function () {
//     return view('tabs');
// });

// Route::get('foods/create', function () {
//     return view('foods/create');
// })->middleware(['auth', 'verified']);

// Route::get('/foods/update/{id}', 'App\Http\Controllers\FoodController@foodUpdate')->middleware(['auth', 'verified']);
// Route::post('/foods/update/{id}', 'App\Http\Controllers\FoodController@update')->middleware(['auth', 'verified']);
// Route::post('/foods/delete/{id}', 'App\Http\Controllers\FoodController@delete')->middleware(['auth', 'verified']);


// // Route::get('foods/update/{foodId}', function () {
// //     return view('foods/update');
// // })->middleware(['auth', 'verified']);

// Route::get('auth/confirm-password', function () {
//     return view('auth/confirm-password');
// });

// Route::get('auth/reset-password', function () {
//     return view('auth/reset-password');
// });

// Route::get('auth/verify-email', function () {
//     return view('auth/verify-email');
// });

// Route::get('line', [LineController::class, 'delete'])->middleware(['auth', 'verified']);

// Route::post('line', [LineController::class, 'create'])->middleware(['auth', 'verified']);
// Route::delete('line', [LineController::class, 'destroy'])->middleware(['auth', 'verified']);
// Route::put('line', [LineController::class, 'update'])->middleware(['auth', 'verified']);


// Route::get('create', function () {
//     return view('create');
// })->middleware(['auth', 'verified']);

// Route::get('test2', function () {
//     return view('test2');
// })->middleware(['auth', 'verified']);

// require __DIR__ . '/auth.php';



// Route::get('/send-email', function () {
//     // $to_email = 't.m.guestmail@gmail.com';
//     $to_email = Auth::user();
//     // $to_email = Auth::email();
//     Mail::to($to_email)->send(new AlertMail());
//     // return 'Send mailing' . $to_email;
//     return 'send-email OK';
// })->middleware(['auth', 'verified']);



// // use Illuminate\Support\Facades\Mail;
// // use App\Mail\AlertMail;

// // Route::get('/send-email', function () {
// //     $to_email = Auth::user();
// //     Mail::to($to_email)->send(new AlertMail());
// //     return $to_email;
// // })->middleware(['auth', 'verified']);