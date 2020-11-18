<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\RegistrationController;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\TaskController;
use App\Http\Controllers\Api\v1\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/email/verify/{id}/{hash}', [RegistrationController::class, 'verify'])->name('verification.verify');

Route::name('public.')->group(function () {
    Route::prefix('v1')->group(function () {
        Route::post('register', [RegistrationController::class, 'register'])->name('registration');
        Route::post('login', [AuthController::class, 'login'])->name('login');

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('task/create', [TaskController::class, 'create'])->name('task.create');
            Route::put('task/update/{task}', [TaskController::class, 'update'])->name('task.update');
            Route::delete('task/delete/{task}', [TaskController::class, 'delete'])->name('task.delete');
            Route::put('task/transform/{task}', [TaskController::class, 'transform'])->name('task.transform');
            Route::put('task/duplicate/{task}', [TaskController::class, 'duplicate'])->name('task.duplicate');
            Route::put('task/complete/{task}', [TaskController::class, 'complete'])->name('task.complete');
            Route::put('task/restore/{task}', [TaskController::class, 'restore'])->name('task.restore');

            Route::post('category/create', [CategoryController::class, 'create'])->name('category.create');
            Route::put('category/update/{category}', [CategoryController::class, 'update'])->name('category.update');
            Route::delete('category/delete/{category}', [CategoryController::class, 'delete'])->name('category.delete');
            Route::put('category/duplicate/{category}', [CategoryController::class, 'duplicate'])->name('category.duplicate');
            Route::put('category/complete/{category}', [CategoryController::class, 'complete'])->name('category.complete');
            Route::put('category/restore/{category}', [CategoryController::class, 'restore'])->name('category.restore');
        });
    });
});
