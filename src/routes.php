<?php

use ggss\upload\controllers\UploadController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
Route::group([
    'prefix'     => config('media.route.prefix'),
    'namespace'  => config('media.route.namespace'),
    'middleware' => config('media.route.middleware'),
], function (Router $router) {
    $router->post('/upload/createImage',[UploadController::class , 'createImage']);
});
