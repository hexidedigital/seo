<?php

declare(strict_types=1);

use Hexide\Seo\Http\Controllers\Api\SeoAnalyticsController;
use Hexide\Seo\Http\Controllers\Api\SeoMicroformatController;
use Hexide\Seo\Http\Controllers\Api\SeoScriptsController;
use Hexide\Seo\Http\Controllers\Api\SeoTemplateController;
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
Route::group(['prefix' => 'templates'], function () {
    Route::get('{model_namespace}/{model_id}', [SeoTemplateController::class, 'modelMeta']);
});

Route::get('microformats/{model_namespace}/{model_id}/{format}', [SeoMicroformatController::class, 'show']);

Route::get('analytics/{type}', [SeoAnalyticsController::class, 'show']);

Route::group(['prefix' => 'scripts'], function () {
    Route::get('/', [SeoScriptsController::class, 'index']);
    Route::get('/{name}', [SeoScriptsController::class, 'show']);
});
