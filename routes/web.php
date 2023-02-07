<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyProfileController;

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

Route::prefix('my-profile')->middleware(['auth', 'verified'])->group(function() {
    Route::get('/', [MyProfileController::class, 'index'])->name('my.profile.index');
    Route::put('/', [MyProfileController::class, 'update'])->name('my.profile.update');
});
