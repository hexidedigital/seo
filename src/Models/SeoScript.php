<?php

namespace Hexide\Seo\Models;

use Illuminate\Database\Eloquent\Model;

class SeoScript extends Model
{
    public const TYPE_HEAD="head";
    public const TYPE_BODY="body";

    protected $fillable = [
        'title',
        'type',
        'text',
    ];

    public static function getTypes(): array
    {
        return [self::TYPE_HEAD, self::TYPE_BODY];
    }
}
