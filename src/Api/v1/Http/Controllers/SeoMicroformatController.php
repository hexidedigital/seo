<?php

declare(strict_types=1);

namespace Hexide\Seo\Api\v1\Http\Controllers;

use Hexide\Seo\Api\v1\Services\SeoModelService;
use Hexide\Seo\Facades\Microformat;

class SeoMicroformatController extends Controller
{
    public function __construct(private SeoModelService $modelService)
    {
        //
    }

    public function show($model_namespace, $model_id, $format)
    {
        $model = $this->modelService->getModel($model_namespace, $model_id);

        $data = Microformat::for($model)->getMicroformat($format);

        return $this->respondWithArray(['value' => $data]);
    }
}
