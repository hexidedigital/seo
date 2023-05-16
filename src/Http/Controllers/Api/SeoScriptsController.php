<?php

declare(strict_types=1);

namespace Hexide\Seo\Http\Controllers\Api;

use Hexide\Seo\Facades\Scripts;
use Illuminate\Http\Request;

class SeoScriptsController extends BaseApiController
{
    public function index(Request $request)
    {
        if ($request->boolean('concat')) {
            Scripts::asText();
        } else {
            Scripts::asArray();
        }

        $data = ['head' => Scripts::getHead(), 'body' => Scripts::getBody()];

        return $this->respondWithData(['value' => $data]);
    }

    public function show(Request $request, $name)
    {
        if ($request->boolean('concat')) {
            Scripts::asText();
        } else {
            Scripts::asArray();
        }

        $data = Scripts::getByName($name);

        return $this->respondWithData(['value' => $data]);
    }
}
