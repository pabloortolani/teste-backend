<?php

use App\Http\Controllers\{LoanController, UserController, BookController};
use Illuminate\Support\Facades\Route;

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

Route::resource('user', UserController::class);
Route::resource('book', BookController::class);

Route::group(['prefix' => 'loan'], function () {
    Route::post('/', LoanController::class.'@create')->name("loan.create");
    Route::patch('/change-status/{loan}', LoanController::class.'@changeStatus')->name("loan.change-status");
});
