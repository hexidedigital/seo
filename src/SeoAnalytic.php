<?php

namespace Hexide\Seo;

class SeoAnalytic
{
    public function getGTM(bool $noscript = false): ?string
    {
        $key = Models\SeoAnalytic::first()?->gtm_id;

        if (! $key) {
            return null;
        }

        if ($noscript) {
            return \Hexide\Seo\Facades\SeoHelper::cleanSpaces(view('seo::partials.gtm.noscript', ['key' => $key])->render());
        }

        return \Hexide\Seo\Facades\SeoHelper::cleanSpaces(view('seo::partials.gtm.main', ['key' => $key])->render());
    }

    public function getGoogleAnalytics(): ?string
    {
        $key = Models\SeoAnalytic::first()?->ga_tracking_id;

        if (! $key) {
            return null;
        }

        return \Hexide\Seo\Facades\SeoHelper::cleanSpaces(view('seo::partials.google_analytics.main', ['key' => $key])->render());
    }

    public function getMetaPixel(bool $noscript = false): ?string
    {
        $key = Models\SeoAnalytic::first()?->fb_pixel_id;

        if (! $key) {
            return null;
        }

        if ($noscript) {
            return \Hexide\Seo\Facades\SeoHelper::cleanSpaces(view('seo::partials.facebook.noscript', ['key' => $key])->render());
        }

        return \Hexide\Seo\Facades\SeoHelper::cleanSpaces(view('seo::partials.facebook.main', ['key' => $key])->render());
    }

    public function getHotjar(): ?string
    {
        $key = Models\SeoAnalytic::first()?->hjar_id;

        if (! $key) {
            return null;
        }

        return \Hexide\Seo\Facades\SeoHelper::cleanSpaces(view('seo::partials.hotjar.main', ['key' => $key])->render());
    }
}
