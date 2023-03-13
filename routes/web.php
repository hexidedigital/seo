<?php

use Hexide\Seo\Http\Controllers\{GeneralMetaController,
    RedirectRuleController,
    ScriptController,
    SeoAnalyticsController,
    SeoMicroformatsController,
    SeoTemplateController,
    XmlSitemapController};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('/templates', SeoTemplateController::class)->except('show');
Route::resource('/microformats', SeoMicroformatsController::class)->except('show');
Route::resource('/scripts', ScriptController::class)->except('show');
Route::resource('/xml-sitemaps', XmlSitemapController::class)
    ->names('xml_sitemaps')
    ->except('show');
Route::resource('/redirect-rules', RedirectRuleController::class)
    ->names('redirect_rules')
    ->except('show');

Route::get('/general-meta', [GeneralMetaController::class, 'edit'])->name('general-meta.edit');
Route::put('/general-meta', [GeneralMetaController::class, 'update'])->name('general-meta.update');

Route::get('/analytics', [SeoAnalyticsController::class, 'edit'])->name('analytics.edit');
Route::put('/analytics', [SeoAnalyticsController::class, 'update'])->name('analytics.update');
