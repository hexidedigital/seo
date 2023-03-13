<?php

namespace Hexide\Seo\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method getFileUrl(?string $path, bool $favicon = false): ?string
 * @method storeImage($image): bool|string
 * @method deleteImage(?string $path): void
 * @method getModelsList(): array
 * @method langRules(array $rules, array $locales = null): array
 * @method getRoute(string $route, $arguments = null): string
 * @method cleanSpaces(string $text): string
 *
 * @see \Hexide\Seo\SeoHelper
 */
class SeoHelper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'seo-helper';
    }
}
