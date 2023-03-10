<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontPageController;
use App\Http\Controllers\MyProfileController;

Route::get('/', [FrontPageController::class, 'index'])->name('front.page.index');
Route::get('/post/{post:slug}', [FrontPageController::class, 'show'])->name('front.page.show');

Auth::routes([
    'verify' => true
]);

Route::prefix('admin')->middleware(['auth', 'verified'])->group(function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::prefix('user')->group(function() {
        Route::get('/list', [UserController::class, 'list'])->name('user.list');
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/{user}', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    });

    Route::prefix('tag')->group(function() {
        Route::get('/list', [TagController::class, 'list'])->name('tag.list');
        Route::get('/', [TagController::class, 'index'])->name('tag.index');
        Route::get('/create', [TagController::class, 'create'])->name('tag.create');
        Route::post('/', [TagController::class, 'store'])->name('tag.store');
        Route::get('/{tag}', [TagController::class, 'edit'])->name('tag.edit');
        Route::put('/{tag}', [TagController::class, 'update'])->name('tag.update');
        Route::delete('/{tag}', [TagController::class, 'destroy'])->name('tag.destroy');
    });

    Route::prefix('category')->group(function() {
        Route::get('/list', [CategoryController::class, 'list'])->name('category.list');
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/{category}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
    });

    Route::prefix('post')->group(function() {
        Route::get('/list', [PostController::class, 'list'])->name('post.list');
        Route::get('/', [PostController::class, 'index'])->name('post.index');
        Route::get('/create', [PostController::class, 'create'])->name('post.create');
        Route::post('/', [PostController::class, 'store'])->name('post.store');
        Route::get('/{post}', [PostController::class, 'edit'])->name('post.edit');
        Route::put('/{post}', [PostController::class, 'update'])->name('post.update');
        Route::delete('/{post}', [PostController::class, 'destroy'])->name('post.destroy');
    });

    Route::prefix('my-profile')->group(function() {
        Route::get('/', [MyProfileController::class, 'index'])->name('my.profile.index');
        Route::put('/', [MyProfileController::class, 'update'])->name('my.profile.update');
    });
});
