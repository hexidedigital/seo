<?php

declare(strict_types=1);

namespace Hexide\Seo\Http\Requests\Traits;

trait HasTranslationRules
{
    protected function formatName(string $name): string
    {
        $prefix = config('translatable.rule_factory.prefix');
        $suffix = config('translatable.rule_factory.suffix');

        return $prefix . $name . $suffix;
    }
}
