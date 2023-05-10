<?php

declare(strict_types=1);

namespace Hexide\Seo\Http\Controllers;

use Hexide\Seo\Facades\SeoHelper;
use Hexide\Seo\Http\Requests\MicroformatStoreRequest;
use Hexide\Seo\Http\Requests\MicroformatUpdateRequest;
use Hexide\Seo\Models\SeoMicroformat;

class SeoMicroformatsController extends Controller
{
    public function index()
    {
        $data = [
            'microformats' => SeoMicroformat::all(),
        ];
        return view('seo::microformats.index', $data);
    }

    public function create()
    {
        $data = [
            'model' => new SeoMicroformat(),
            'models' => SeoHelper::getModelsList(),
        ];
        return view('seo::microformats.create', $data);
    }

    public function store(MicroformatStoreRequest $request)
    {
        $data = $request->validated();

        SeoMicroformat::create($data);

        return redirect(SeoHelper::getRoute('microformats.index'));
    }

    public function edit(SeoMicroformat $microformat)
    {
        $data = [
            'model' => $microformat,
        ];
        return view('seo::microformats.edit', $data);
    }

    public function update(SeoMicroformat $microformat, MicroformatUpdateRequest $request)
    {
        $data = $request->validated();

        $microformat->update($data);

        return redirect(SeoHelper::getRoute('microformats.index'));
    }

    public function destroy(SeoMicroformat $microformat)
    {
        $microformat->delete();

        return redirect(SeoHelper::getRoute('microformats.index'));
    }
}
