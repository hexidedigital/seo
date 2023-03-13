<?php

namespace Hexide\Seo\Models;

use Illuminate\Database\Eloquent\Model;

class SeoTemplateTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'keywords',
        'og_title',
        'og_description',
        'og_image',
        'image_alt',
        'image_title',
    ];
}
