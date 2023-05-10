<?php

declare(strict_types=1);

namespace Hexide\Seo\Http\Controllers;

use Hexide\Seo\Http\Requests\SeoAnalyticUpdateRequest;
use Hexide\Seo\Models\SeoAnalytic;

class SeoAnalyticsController extends Controller
{
    public function edit()
    {
        $analytic = SeoAnalytic::firstOrCreate([]);
        return view('seo::seo_analytics.edit', ['model' => $analytic]);
    }

    public function update(SeoAnalyticUpdateRequest $request)
    {
        $analytic = SeoAnalytic::firstOrCreate([]);

        $data = $request->validated();

        $analytic->update($data);

        return redirect()->back();
    }
}
