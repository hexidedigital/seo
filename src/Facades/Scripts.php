<?php

declare(strict_types=1);

namespace Hexide\Seo\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method getHead(): string|array
 * @method getBody(): string|array
 * @method getByName(string $name): ?string
 * @method asArray(): self
 * @method asText(): self
 *
 * @see \Hexide\Seo\Script
 */
class Scripts extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'scripts';
    }
}
