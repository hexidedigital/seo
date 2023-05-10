<?php

declare(strict_types=1);

namespace Hexide\Seo\Interfaces;

interface XmlGenerator
{
    public static function generate(int $page): array;
}
