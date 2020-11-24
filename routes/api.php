<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\RegistrationController;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\TaskController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\ListController;
use \App\Http\Controllers\Api\v1\OptionController;

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
            Route::put('task/move/{task}', [TaskController::class, 'move'])->name('task.move');

            Route::post('category/create', [CategoryController::class, 'create'])->name('category.create');
            Route::put('category/update/{category}', [CategoryController::class, 'update'])->name('category.update');
            Route::delete('category/delete/{category}', [CategoryController::class, 'delete'])->name('category.delete');
            Route::put('category/duplicate/{category}', [CategoryController::class, 'duplicate'])->name('category.duplicate');
            Route::put('category/complete/{category}', [CategoryController::class, 'complete'])->name('category.complete');
            Route::put('category/restore/{category}', [CategoryController::class, 'restore'])->name('category.restore');

            Route::get('list/inbox', [ListController::class, 'inbox'])->name('list.inbox');
            Route::get('list/today', [ListController::class, 'today'])->name('list.today');
            Route::get('list/any', [ListController::class, 'any'])->name('list.any');
            Route::get('list/tomorrow', [ListController::class, 'tomorrow'])->name('list.tomorrow');
            Route::get('list/archive', [ListController::class, 'archive'])->name('list.archive');
            Route::get('list/schedule', [ListController::class, 'schedule'])->name('list.schedule');

            Route::post('option/create/task/{task}', [OptionController::class, 'create'])->name('option.create');
            Route::put('option/update/{option}', [OptionController::class, 'update'])->name('option.update');
            Route::delete('option/delete/{option}', [OptionController::class, 'delete'])->name('option.delete');
            Route::put('option/complete/{option}', [OptionController::class, 'complete'])->name('option.complete');
            Route::put('option/restore/{option}', [OptionController::class, 'restore'])->name('option.restore');
        });
    });
});
