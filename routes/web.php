<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyProfileController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'verify' => true
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth', 'verified'])->group(function() {
    Route::prefix('user')->group(function() {
        Route::get('/list', [UserController::class, 'list'])->name('user.list');
        Route::get('/', [UserController::class, 'index'])->name('user.index');
    });

    Route::prefix('my-profile')->group(function() {
        Route::get('/', [MyProfileController::class, 'index'])->name('my.profile.index');
        Route::put('/', [MyProfileController::class, 'update'])->name('my.profile.update');
    });
});
