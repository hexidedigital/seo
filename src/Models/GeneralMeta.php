<?php

declare(strict_types=1);

namespace Hexide\Seo\Models;

use Astrotomic\Translatable\Translatable;
use Hexide\Seo\Models\Traits\WithTranslations;
use Illuminate\Database\Eloquent\Model;

class GeneralMeta extends Model
{
    use Translatable;
    use WithTranslations;

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
