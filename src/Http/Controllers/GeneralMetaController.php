<?php

declare(strict_types=1);

namespace Hexide\Seo\Http\Controllers;

use Hexide\Seo\Facades\SeoHelper;
use Hexide\Seo\Http\Requests\GeneralMetaUpdateRequest;
use Hexide\Seo\Models\GeneralMeta;

class GeneralMetaController extends Controller
{
    public function edit()
    {
        $generalMeta = GeneralMeta::firstOrCreate([]);
        return view('seo::general_metas.edit', ['model' => $generalMeta]);
    }

    public function update(GeneralMetaUpdateRequest $request)
    {
        $generalMeta = GeneralMeta::firstOrCreate([]);
        $data = $request->safe()->except('og_image', 'isRemoveImage');
        foreach (config('translatable.locales') as $locale) {
            if ($request->hasFile($locale.'.og_image')) {
                $data[$locale]['og_image'] = SeoHelper::storeImage($request->file($locale.'.og_image'));
                SeoHelper::deleteImage($generalMeta->translate($locale)?->og_image);
            } elseif($request->boolean($locale.'.isRemoveImage')) {
                $data[$locale]['og_image'] = null;
                SeoHelper::deleteImage($generalMeta->translate($locale)?->og_image);
            }
        }

        $generalMeta->update($data);

        return redirect()->back();
    }
}
