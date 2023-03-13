<?php

namespace Hexide\Seo\Models;

use Illuminate\Database\Eloquent\Model;

class SeoAnalytic extends Model
{
    protected $fillable = [
        'gtm_id',
        'ga_tracking_id',
        'fb_pixel_id',
        'hjar_id',
    ];
}
