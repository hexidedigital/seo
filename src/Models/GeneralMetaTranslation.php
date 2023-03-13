<?php

namespace Hexide\Seo\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralMetaTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'keywords',
        'og_title',
        'og_description',
        'og_image',
        'og_image_alt',
        'og_image_title',
    ];
}
