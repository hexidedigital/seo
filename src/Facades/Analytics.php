<?php

declare(strict_types=1);

namespace Hexide\Seo\Facades;

use Hexide\Seo\SeoAnalytic;
use Illuminate\Support\Facades\Facade;

/**
 * @method getGTM(bool $noscript = false): ?string
 * @method getGoogleAnalytics(): ?string
 * @method getMetaPixel(bool $noscript = false): ?string
 * @method getHotjar(): ?string
 *
 * @see SeoAnalytic
 */
class Analytics extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'analytics';
    }
}
