<?php

namespace Hexide\Seo\Api\v1\Http\Controllers;

use Hexide\Seo\Facades\Scripts;
use Illuminate\Http\Request;

class SeoScriptsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->boolean('concat')) {
            Scripts::asText();
        } else {
            Scripts::asArray();
        }

        $data = ['head' => Scripts::getHead(), 'body' => Scripts::getBody()];

        return $this->respondWithArray(['value' => $data]);
    }

    public function show(Request $request, $name)
    {
        if ($request->boolean('concat')) {
            Scripts::asText();
        } else {
            Scripts::asArray();
        }

        $data = Scripts::getByName($name);

        return $this->respondWithArray(['value' => $data]);
    }
}
