<?php

declare(strict_types=1);

namespace Hexide\Seo\Services;

use Hexide\Seo\Facades\SeoHelper;

class SeoTemplateService
{
    private $variableRegex;

    public function __construct()
    {
        $prefix = config('hexide-seo.variables.prefix', '{\$');
        $postfix = config('hexide-seo.variables.postfix', '}');
        $this->variableRegex = "/" . $prefix . "([^" . $postfix . "\\s]+)" . $postfix . "/";
    }

    public function getText(string $text, $model): string
    {
        $text = preg_replace_callback(
            $this->variableRegex,
            fn ($matches) => $model?->{$matches[1]} ?? '',
            $text
        );

        return SeoHelper::cleanSpaces($text);
    }
}
