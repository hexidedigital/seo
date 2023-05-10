<?php

declare(strict_types=1);

namespace Hexide\Seo\Http\Controllers;

use Hexide\Seo\Facades\SeoHelper;
use Hexide\Seo\Http\Requests\ScriptStoreRequest;
use Hexide\Seo\Http\Requests\ScriptUpdateRequest;
use Hexide\Seo\Models\SeoScript;

class ScriptController extends Controller
{
    public function index()
    {
        $data = [
            'scripts' => SeoScript::all(),
        ];
        return view('seo::scripts.index', $data);
    }

    public function create()
    {
        $data = [
            'model' => new SeoScript(),
            'types' => SeoScript::getTypes(),
        ];
        return view('seo::scripts.create', $data);
    }

    public function store(ScriptStoreRequest $request)
    {
        $data = $request->validated();

        SeoScript::create($data);

        return redirect(SeoHelper::getRoute('scripts.index'));
    }

    public function edit(SeoScript $script)
    {
        $data = [
            'model' => $script,
            'types' => SeoScript::getTypes(),
        ];
        return view('seo::scripts.edit', $data);
    }

    public function update(SeoScript $script, ScriptUpdateRequest $request)
    {
        $data = $request->validated();

        $script->update($data);

        return redirect(SeoHelper::getRoute('scripts.index'));
    }

    public function destroy(SeoScript $script)
    {
        $script->delete();

        return redirect(SeoHelper::getRoute('scripts.index'));
    }
}
