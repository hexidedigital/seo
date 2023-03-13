<?php

namespace Hexide\Seo\Models;

use Illuminate\Database\Eloquent\Model;

class SeoMicroformat extends Model
{
    protected $fillable = [
        'title',
        'text'
    ];
}
