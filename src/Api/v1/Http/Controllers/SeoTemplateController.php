<?php

namespace Hexide\Seo\Api\v1\Http\Controllers;

use Hexide\Seo\Api\v1\Services\SeoModelService;
use Hexide\Seo\Facades\Meta;
use Illuminate\Http\Request;

class SeoTemplateController extends Controller
{
    public function __construct(private SeoModelService $modelService)
    {
        //
    }

    public function modelMeta(Request $request, $model_namespace, $model_id)
    {
        $model = $this->modelService->getModel($model_namespace, $model_id);

        $data = $request->boolean('as_html')
            ? Meta::for($model)->getMetaView($request->except('as_html'))
            : Meta::for($model)->getAllMeta($request->except('as_html'));

        return $this->respondWithArray(['value' => $data]);
    }
}
