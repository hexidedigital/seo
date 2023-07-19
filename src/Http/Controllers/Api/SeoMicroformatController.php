<?php

declare(strict_types=1);

namespace Hexide\Seo\Http\Controllers\Api;

use Hexide\Seo\Facades\Microformat;
use Hexide\Seo\Services\DatabaseModelFinder;

class SeoMicroformatController extends BaseApiController
{
    public function __construct(
        protected readonly DatabaseModelFinder $modelService
    ) {
    }

    public function show(string $model_namespace, $model_id, string $format)
    {
        $model = $this->modelService->findModel($model_namespace, $model_id);

        $data = Microformat::for($model)->getMicroformat($format);

        return $this->respondWithData(['value' => $data]);
    }
}
