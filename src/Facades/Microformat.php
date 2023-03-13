<?php

namespace Hexide\Seo\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method for($model): self
 * @method getMicroformat(string $formatName): ?string
 *
 * @see \Hexide\Seo\Microformat
 */
class Microformat extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'microformat';
    }
}
