<?php

namespace Hexide\Seo\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SeoTemplateModels extends Model
{
    protected $fillable = [
        'seo_template_id',
        'model_name'
    ];

    public function template(): BelongsTo
    {
        return $this->belongsTo(SeoTemplate::class, 'seo_template_id');
    }
}
