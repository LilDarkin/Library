<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\BorrowedBooksController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::inertia('/about', 'About')->name('pages.about');

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UsersController::class, 'index'])->name('users');
        Route::put('api/{id}', [UsersController::class, 'edit'])->name('edit.user');
        Route::delete('api/{id}', [UsersController::class, 'destroy'])->name('delete.user');
        Route::post('api/add', [UsersController::class, 'store'])->name('add.user');
    });

    Route::group(['prefix' => 'books'], function () {
        Route::get('/', [BooksController::class, 'index'])->name('books');
    });

    Route::group(['prefix' => 'borrowed-books'], function () {
        Route::get('/', [BorrowedBooksController::class, 'index'])->name('borrowed-books');
    });
});

Route::inertia('login', 'Auth/Login')->name('login');
Route::post('login', [LoginController::class, 'store'])->name('login.post');
Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
