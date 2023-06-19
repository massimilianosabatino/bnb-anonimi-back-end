<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisteredUser\ApartmentController;
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

//Route default
Route::get('/', function () {
    return view('auth.login');
});

//Route Auth Apartment
// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Rotta utente autenticato
Route::middleware('auth')
    ->prefix('user')
    ->name('user.')
    ->group(function () {
        Route::get('dashboard', function(){
            return view('user.dashboard');
        })->name('dashboard');
        Route::resource('apartment', ApartmentController::class);
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });


//Route profile
// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


require __DIR__.'/auth.php';
