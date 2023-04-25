<?php

use App\Http\Controllers\API\V1\PostController;
use App\Http\Controllers\API\V1\SubscriptionController;
use App\Http\Controllers\API\V1\WebSiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => '/v1'], function () {

    Route::group(['prefix' => 'websites'], function () {
        Route::get('/', [WebSiteController::class, 'index']);
    });

    Route::group(['prefix' => 'posts'], function () {
        Route::get('/', [PostController::class, 'index']);
        Route::post('/', [PostController::class, 'store']);
        Route::get('/{id}', [PostController::class, 'show']);
    });

    Route::group(['prefix' => 'subscriptions'], function () {
        Route::post('/', [SubscriptionController::class, 'store']);
    });

});
