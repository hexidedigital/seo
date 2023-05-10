<?php

declare(strict_types=1);

namespace Hexide\Seo\Http\Requests;

use Hexide\Seo\Facades\SeoHelper;
use Illuminate\Foundation\Http\FormRequest;

class TemplateUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        $id = $this->route()->parameter('template')?->id;
        $rules = [
            'group' => ['required', 'string', 'max:191'],
            $this->setTranslate('title') => ['nullable', 'string', 'max:191'],
            $this->setTranslate('description') => ['nullable', 'string', 'max:191'],
            $this->setTranslate('keywords') => ['nullable', 'string', 'max:191'],
            $this->setTranslate('og_title') => ['nullable', 'string', 'max:191'],
            $this->setTranslate('og_description') => ['nullable', 'string', 'max:191'],
            $this->setTranslate('og_image') => ['nullable', 'image'],
            $this->setTranslate('image_alt') => ['nullable', 'string', 'max:191'],
            $this->setTranslate('image_title') => ['nullable', 'string', 'max:191'],
            'models' => ['nullable', 'array'],
            'models.*' => ['required', 'unique:seo_template_models,model_name,' . $id . ',seo_template_id'],
        ];

        return SeoHelper::langRules($rules);
    }

    public function messages(): array
    {
        $messages = [];

        foreach ($this->get('models', []) as $key => $val) {
            $messages["models.$key.unique"] = "$val model is already connected to template";
        }

        return $messages;
    }

    public function setTranslate(string $name): string
    {
        $prefix = config('translatable.rule_factory.prefix');
        $suffix = config('translatable.rule_factory.suffix');

        return $prefix . $name . $suffix;
    }
}
