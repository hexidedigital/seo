<?php

namespace Hexide\Seo\Api\v1\Http\Controllers;

use Hexide\Seo\Facades\Analytics;
use Illuminate\Http\Request;

class SeoAnalyticsController extends Controller
{
    public function showGtm(Request $request)
    {
        $data = Analytics::getGTM($request->boolean('noscript'));

        return $this->respondWithArray(['value' => $data]);
    }

    public function showGoogleAnalytics()
    {
        $data = Analytics::getGoogleAnalytics();

        return $this->respondWithArray(['value' => $data]);
    }

    public function showMetaPixel(Request $request)
    {
        $data = Analytics::getMetaPixel($request->boolean('noscript'));

        return $this->respondWithArray(['value' => $data]);
    }

    public function showHotjar()
    {
        $data = Analytics::getHotjar();

        return $this->respondWithArray(['value' => $data]);
    }
}
