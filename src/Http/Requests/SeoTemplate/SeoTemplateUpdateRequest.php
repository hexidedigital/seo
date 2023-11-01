<?php

declare(strict_types=1);

namespace Hexide\Seo\Http\Requests\SeoTemplate;

use Hexide\Seo\Facades\SeoHelper;
use Hexide\Seo\Http\Requests\Traits\HasTranslationRules;
use Hexide\Seo\Models\SeoTemplate;
use Hexide\Seo\Models\SeoTemplateModels;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SeoTemplateUpdateRequest extends FormRequest
{
    use HasTranslationRules;

    public function rules(): array
    {
        $id = $this->route('template');
        if ($id instanceof SeoTemplate) {
            $id = $id->id;
        }
        $rules = [
            'group' => ['required', 'string', 'max:255'],
            $this->formatName('title') => ['nullable', 'string', 'max:255'],
            $this->formatName('description') => ['nullable', 'string', 'max:255'],
            $this->formatName('keywords') => ['nullable', 'string', 'max:255'],
            $this->formatName('og_title') => ['nullable', 'string', 'max:255'],
            $this->formatName('og_description') => ['nullable', 'string', 'max:255'],
            $this->formatName('og_image') => ['nullable', 'image'],
            $this->formatName('image_alt') => ['nullable', 'string', 'max:255'],
            $this->formatName('image_title') => ['nullable', 'string', 'max:255'],

            'models' => ['required', 'array'],
            'models.*' => [
                'required',
                Rule::unique(SeoTemplateModels::class, 'model_name')
                    ->ignore($id, 'seo_template_id'),
            ],
        ];

        return SeoHelper::langRules($rules);
    }

    public function messages(): array
    {
        $messages = [];

        foreach ($this->get('models', []) as $key => $val) {
            $messages["models.{$key}.unique"] = "{$val} model is already connected to template";
        }

        return $messages;
    }
}
