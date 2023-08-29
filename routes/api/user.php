<?php

use App\Http\Controllers\User\FindUserController;
use App\Http\Controllers\User\GetCurrentUserController;
use App\Http\Controllers\User\UserResourceController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware'    => ['cors', 'json.response', 'auth:sanctum'],
    'prefix'        => 'user',
], function ($route) {

    $route->get('', [UserResourceController::class, 'all']);
    $route->post('', [UserResourceController::class, 'store']);
    $route->put('', [UserResourceController::class, 'modify']);
    $route->delete('', [UserResourceController::class, 'destroy']);

    $route->get('me', GetCurrentUserController::class);
    $route->get('get/{id}', FindUserController::class);
});