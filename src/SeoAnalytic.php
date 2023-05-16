<?php

declare(strict_types=1);

namespace Hexide\Seo;

use Hexide\Seo\Models\SeoAnalytic as SeoAnalyticModel;

class SeoAnalytic
{
    protected string $key;
    protected string $viewType;
    protected bool $noscript = false;

    public function getGTM(bool $noscript = false): ?string
    {
        $this->key = 'gtm_id';
        $this->viewType = 'gtm';
        $this->noscript = $noscript;

        return $this->getValue();
    }

    public function getGoogleAnalytics(): ?string
    {
        $this->key = 'ga_tracking_id';
        $this->viewType = 'google_analytics';

        return $this->getValue();
    }

    public function getMetaPixel(bool $noscript = false): ?string
    {
        $this->key = 'fb_pixel_id';
        $this->viewType = 'facebook';
        $this->noscript = $noscript;

        return $this->getValue();
    }

    public function getHotjar(): ?string
    {
        $this->key = 'hjar_id';
        $this->viewType = 'hotjar';

        return $this->getValue();
    }

    protected function getValue(): ?string
    {
        $key = $this->getModel()?->getAttribute($this->key);

        if (!$key) {
            return null;
        }

        return $this->getContent($this->resolveViewName(), $key);
    }

    protected function getModel(): SeoAnalyticModel
    {
        return SeoAnalyticModel::first();
    }

    protected function resolveViewName(): string
    {
        $base = "seo::partials.{$this->viewType}";

        if ($this->noscript) {
            return "{$base}.noscript";
        }

        return "{$base}.main";
    }

    protected function getContent(string $view, $key): string
    {
        return \Hexide\Seo\Facades\SeoHelper::cleanSpaces(
            view($view, ['key' => $key])->render()
        );
    }
}
