<?php

declare(strict_types=1);

namespace Hexide\Seo;

use Hexide\Seo\Models\SeoMicroformat;
use Hexide\Seo\Services\SeoTemplateService;

class Microformat
{
    private SeoTemplateService $templateService;
    private $model;

    public function __construct( $model = null)
    {
        $this->templateService = new SeoTemplateService();
    }

    public function for($model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getMicroformat(string $formatName): ?string
    {
        $format = SeoMicroformat::where('title', $formatName)->first();

        if (!$format) {
            return null;
        }

        return $this->templateService->getText($format->text, $this->model);
    }
}
