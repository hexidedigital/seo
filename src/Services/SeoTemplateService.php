<?php

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
            function ($matches) use ($model) {
                return $model?->{$matches[1]} ?? '';
            },
            $text
        );

        $text = SeoHelper::cleanSpaces($text);

        return $text;
    }
}
