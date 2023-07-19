<?php

declare(strict_types=1);

namespace Hexide\Seo\Models;

use Astrotomic\Translatable\Translatable;
use Hexide\Seo\Models\Traits\WithTranslations;
use Illuminate\Database\Eloquent\Model;

/**
 * @method GeneralMetaTranslation translate(?string $locale = null, bool $withFallback = false)
 * @mixin GeneralMetaTranslation
 */
class GeneralMeta extends Model
{
    use Translatable;
    use WithTranslations;

    public $translationModel = GeneralMetaTranslation::class;

    protected $table = 'general_metas';

    protected array $translatedAttributes = [
        'group',
        'title',
        'description',
        'keywords',
        'og_title',
        'og_description',
        'og_image',
    ];

    protected $fillable = [];
}
