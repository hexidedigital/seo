<?php

declare(strict_types=1);

namespace Hexide\Seo\Models;

use Illuminate\Database\Eloquent\Model;

class SeoMicroformat extends Model
{
    protected $fillable = [
        'title',
        'text',
    ];
}
