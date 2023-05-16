<?php

declare(strict_types=1);

namespace Hexide\Seo\Api\v1\Http\Controllers;

use Hexide\Seo\Api\v1\Services\SeoModelService;
use Hexide\Seo\Facades\Microformat;

class SeoMicroformatController extends Controller
{
    public function __construct(
        protected readonly SeoModelService $modelService
    ) {
    }

    public function show(string $model_namespace, $model_id, string $format)
    {
        $model = $this->modelService->findModel($model_namespace, $model_id);

        $data = Microformat::for($model)->getMicroformat($format);

        return $this->respondWithArray(['value' => $data]);
    }
}
