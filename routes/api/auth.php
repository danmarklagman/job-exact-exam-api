<?php

use App\Http\Controllers\Auth\CheckAuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware'    => ['cors', 'json.response'],
    'prefix'        => 'auth',
], function ($route) {

    $route->post('login', LoginController::class);
});

Route::group([
    'middleware'    => ['cors', 'json.response', 'auth:sanctum'],
    'prefix'        => 'auth',
], function ($route) {

    $route->get('check', CheckAuthController::class);
    $route->get('me', CheckAuthController::class);
    $route->post('logout', LogoutController::class);
});