<?php

use App\Http\Controllers\Album\FindAlbumController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware'    => ['cors', 'json.response', 'auth:sanctum'],
    'prefix'        => 'album',
], function ($route) {

    $route->get('get/{id}', FindAlbumController::class);
});