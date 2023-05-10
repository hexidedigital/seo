<?php

use Hexide\Seo\Api\v1\Http\Controllers\SeoAnalyticsController;
use Hexide\Seo\Api\v1\Http\Controllers\SeoMicroformatController;
use Hexide\Seo\Api\v1\Http\Controllers\SeoScriptsController;
use Hexide\Seo\Api\v1\Http\Controllers\SeoTemplateController;
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

Route::group(['prefix' => 'analytics'], function () {
    Route::get('gtm', [SeoAnalyticsController::class, 'showGtm']);
    Route::get('google-analytics', [SeoAnalyticsController::class, 'showGoogleAnalytics']);
    Route::get('meta-pixel', [SeoAnalyticsController::class, 'showMetaPixel']);
    Route::get('hotjar', [SeoAnalyticsController::class, 'showHotjar']);
});

Route::group(['prefix' => 'scripts'], function () {
    Route::get('/', [SeoScriptsController::class, 'index']);
    Route::get('/{name}', [SeoScriptsController::class, 'show']);
});
