<?php

declare(strict_types=1);

namespace Hexide\Seo\Http\Controllers\Api;

use Hexide\Seo\SeoAnalytic;
use Illuminate\Http\Request;

class SeoAnalyticsController extends BaseApiController
{
    public function __construct(
        protected SeoAnalytic $seoAnalytic
    ) {
    }

    public function show(Request $request, string $type)
    {
        $analyticsData = $this->getAnalyticsData($type, $request->boolean('noscript'));

        return $this->respondWithData(['value' => $analyticsData]);
    }

    protected function getAnalyticsData(string $analyticsType, bool $noscript = false)
    {
        return match ($analyticsType) {
            'gtm' => $this->seoAnalytic->getGTM($noscript),
            'google' => $this->seoAnalytic->getGoogleAnalytics(),
            'metapixel' => $this->seoAnalytic->getMetaPixel($noscript),
            'hotjar' => $this->seoAnalytic->getHotjar(),
            default => null,
        };
    }
}
