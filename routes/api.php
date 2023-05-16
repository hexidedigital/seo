<?php

declare(strict_types=1);

use Hexide\Seo\Http\Controllers\Api\SeoAnalyticsBaseApiController;
use Hexide\Seo\Http\Controllers\Api\SeoMicroformatBaseApiController;
use Hexide\Seo\Http\Controllers\Api\SeoScriptsBaseApiController;
use Hexide\Seo\Http\Controllers\Api\SeoTemplateBaseApiController;
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
    Route::get('{model_namespace}/{model_id}', [SeoTemplateBaseApiController::class, 'modelMeta']);
});

Route::get('microformats/{model_namespace}/{model_id}/{format}', [SeoMicroformatBaseApiController::class, 'show']);

Route::get('analytics/{type}', [SeoAnalyticsBaseApiController::class, 'show']);

Route::group(['prefix' => 'scripts'], function () {
    Route::get('/', [SeoScriptsBaseApiController::class, 'index']);
    Route::get('/{name}', [SeoScriptsBaseApiController::class, 'show']);
});
