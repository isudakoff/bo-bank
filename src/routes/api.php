<?php

use App\Http\Controllers\BalanceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResources([
    'users' => UserController::class,
], [
    'only' => ['update'],
]);

Route::group(['controller' => BalanceController::class], function () {
    Route::get('users/{user}/balance', 'show');
    Route::post('users/{user}/deposit', 'deposit');
});
