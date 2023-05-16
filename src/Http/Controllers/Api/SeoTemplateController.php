<?php

declare(strict_types=1);

namespace Hexide\Seo\Http\Controllers\Api;

use Hexide\Seo\Facades\Meta;
use Hexide\Seo\Services\DatabaseModelFinder;
use Illuminate\Http\Request;

class SeoTemplateController extends BaseApiController
{
    public function __construct(private DatabaseModelFinder $modelService)
    {
    }

    public function modelMeta(Request $request, $model_namespace, $model_id)
    {
        $model = $this->modelService->findModel($model_namespace, $model_id);

        $data = $request->boolean('as_html')
            ? Meta::for($model)->getMetaView($request->except('as_html'))
            : Meta::for($model)->getAllMeta($request->except('as_html'));

        return $this->respondWithData(['value' => $data]);
    }
}
