<?php

namespace Hexide\Seo\Http\Controllers;

use Hexide\Seo\Facades\SeoHelper;
use Hexide\Seo\Http\Requests\TemplateStoreRequest;
use Hexide\Seo\Http\Requests\TemplateUpdateRequest;
use Hexide\Seo\Models\SeoTemplate;

class SeoTemplateController extends Controller
{
    public function index()
    {
        $data = [
            'templates' => SeoTemplate::all(),
        ];
        return view('seo::templates.index', $data);
    }

    public function create()
    {
        $data = [
            'model' => new SeoTemplate(),
            'models' => SeoHelper::getModelsList(),
        ];
        return view('seo::templates.create', $data);
    }

    public function store(TemplateStoreRequest $request)
    {
        $data = $request->safe()->except('og_image', 'models');


        $models = $request->get('models', []);

        foreach (config('translatable.locales') as $locale) {
            if ($request->hasFile($locale . '.og_image')) {
                $data[$locale]['og_image'] = SeoHelper::storeImage($request->file($locale . '.og_image'));
            }
        }

        $template = SeoTemplate::create($data);

        $this->syncModels($template, $models);

        return redirect(SeoHelper::getRoute('templates.index'));
    }

    public function edit(SeoTemplate $template)
    {
        $data = [
            'model' => $template,
            'models' => SeoHelper::getModelsList(),
        ];
        return view('seo::templates.edit', $data);
    }

    public function update(SeoTemplate $template, TemplateUpdateRequest $request)
    {
        $data = $request->safe()->except('og_image', 'models');

        $models = $request->get('models', []);

        foreach (config('translatable.locales') as $locale)
        {
            if ($request->hasFile($locale.'.og_image')) {
                $data[$locale]['og_image'] = SeoHelper::storeImage($request->file($locale.'.og_image'));
                SeoHelper::deleteImage($template->translate($locale)?->og_image);
            } elseif($request->boolean($locale.'.isRemoveImage')) {
                $data[$locale]['og_image'] = null;
                SeoHelper::deleteImage($template->translate($locale)?->og_image);
            }
        }

        $template->update($data);

        $this->syncModels($template, $models);

        return redirect(SeoHelper::getRoute('templates.index'));
    }

    public function destroy(SeoTemplate $template)
    {
        $template->delete();

        return redirect(SeoHelper::getRoute('templates.index'));
    }

    private function syncModels(SeoTemplate $template, array $models)
    {
        $template->models()->whereNotIn('model_name', $models)->delete();

        $id = $template->id;

        $models = collect($models)
            ->map(
                function ($model) use ($id) {
                    return [
                        'seo_template_id' => $id,
                        'model_name' => $model
                    ];
                }
            )
            ->toArray();

        $template->models()->upsert($models, ['model_name']);
    }
}
