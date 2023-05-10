<?php

namespace Hexide\Seo\Models;

use Illuminate\Database\Eloquent\Model;

class RedirectRule extends Model
{
    protected $fillable = [
        'rule',
        'redirect_url',
    ];
}
