<?php

namespace Hexide\Seo\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method getMetaTitle(): ?string
 * @method getMetaTitleAsHtml(): ?string
 * @method getMetaDescription(): ?string
 * @method getMetaDescriptionAsHtml(): ?string
 * @method getMetaKeywords(): ?string
 * @method getMetaKeywordsAsHtml(): ?string
 * @method getOgTitle(): ?string
 * @method getOgTitleAsHtml(): ?string
 * @method getOgDescription(): ?string
 * @method getOgDescriptionAsHtml(): ?string
 * @method getOgImage(): ?string
 * @method getOgImageAsHtml(): ?string
 * @method getImageAlt(): ?string
 * @method getImageTitle(): ?string
 * @method getOgSiteName(): ?string
 * @method getOgSiteNameAsHtml(): ?string
 * @method getOgUrl(): string
 * @method getOgUrlAsHtml(): ?string
 * @method getCanonicalUrl(): string
 * @method getCanonicalUrlAsHtml(): string
 * @method getLocalizationMeta(string $url): array
 * @method getLocalizationMetaAsHtml(string $url): string
 *
 * @see \Hexide\Seo\Seo
 */
class Meta extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'meta';
    }
}
