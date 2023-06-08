<?php

use App\Http\Controllers\ClassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
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

// Route::get('/', [LoginController::class, 'index']);
Route::middleware(['web'])->group(function (){
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/sign-in', [LoginController::class, 'login'])->name('signIn');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware(['auth'])->group(function (){
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::group(['prefix' => 'user'], function (){
            Route::get('/', [UserController::class, 'index'])->name('user.index');
            Route::post('/store', [UserController::class, 'store'])->name('user.store');
            Route::put('/update', [UserController::class, 'update'])->name('user.update');
            Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');
            Route::get('/get-list', [UserController::class, 'userList'])->name('user.list');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');

        });

        Route::group(['prefix' => 'student'], function (){
            Route::get('/', [StudentController::class, 'index'])->name('student.index');
            Route::post('/store', [StudentController::class, 'store'])->name('student.store');
            Route::put('/update', [StudentController::class, 'update'])->name('student.update');
            Route::delete('/delete/{id}', [StudentController::class, 'destroy'])->name('student.destroy');
            Route::get('/get-list', [StudentController::class, 'studentList'])->name('student.list');
            Route::get('/edit/{id}', [StudentController::class, 'edit'])->name('student.edit');
            Route::get('/get-export-format', [StudentController::class, 'getExportFormat'])->name('student.export_format');
            Route::post('/import', [StudentController::class, 'importData'])->name('student.import');
        });


        Route::group(['prefix' => 'class'], function (){
            Route::get('/', [ClassController::class, 'index'])->name('class.index');
            Route::post('/store', [ClassController::class, 'store'])->name('class.store');
            Route::put('/update', [ClassController::class, 'update'])->name('class.update');
            Route::delete('/delete/{id}', [ClassController::class, 'destroy'])->name('class.destroy');
            Route::get('/get-list', [ClassController::class, 'classList'])->name('class.list');
            Route::get('/edit/{id}', [ClassController::class, 'edit'])->name('class.edit');
        });
    });
});

