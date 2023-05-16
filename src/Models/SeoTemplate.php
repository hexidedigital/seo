<?php

declare(strict_types=1);

namespace Hexide\Seo\Models;

use Astrotomic\Translatable\Translatable;
use Hexide\Seo\Models\Traits\WithTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SeoTemplate extends Model
{
    use Translatable;
    use WithTranslations;

    protected array $translatedAttributes = [
        'title',
        'description',
        'keywords',
        'og_title',
        'og_description',
        'og_image',
        'image_alt',
        'image_title',
    ];

    protected $fillable = [
        'group',
    ];

    public function models(): HasMany
    {
        return $this->hasMany(SeoTemplateModels::class);
    }
}
