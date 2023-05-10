<?php

declare(strict_types=1);

namespace Hexide\Seo;

use Hexide\Seo\Models\SeoScript;

class Script
{
    private bool $isArray = false;

    public function getHead(): string|array
    {
        $scripts = SeoScript::where('type', SeoScript::TYPE_HEAD)
            ->pluck('text')
            ->toArray();

        if ($this->isArray) {
            return $scripts;
        }

        return implode('', $scripts);
    }

    public function getBody(): string|array
    {
        $scripts = SeoScript::where('type', SeoScript::TYPE_BODY)
            ->pluck('text')
            ->toArray();

        if ($this->isArray) {
            return $scripts;
        }

        return implode('', $scripts);
    }

    public function getByName(string $name): ?string
    {
        return SeoScript::where('title', $name)->first()?->text;
    }

    public function asArray(): self
    {
        $this->isArray = true;
        return $this;
    }

    public function asText(): self
    {
        $this->isArray = false;
        return $this;
    }
}
