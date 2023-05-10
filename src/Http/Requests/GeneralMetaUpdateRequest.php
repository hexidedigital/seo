<?php

declare(strict_types=1);

namespace Hexide\Seo\Http\Requests;

use Hexide\Seo\Facades\SeoHelper;
use Illuminate\Foundation\Http\FormRequest;

class GeneralMetaUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            $this->setTranslate('title') => ['nullable', 'string', 'max:191'],
            $this->setTranslate('description') => ['nullable', 'string', 'max:191'],
            $this->setTranslate('keywords') => ['nullable', 'string', 'max:191'],
            $this->setTranslate('og_title') => ['nullable', 'string', 'max:191'],
            $this->setTranslate('og_description') => ['nullable', 'string', 'max:191'],
            $this->setTranslate('og_image') => ['nullable', 'image'],
        ];

        return SeoHelper::langRules($rules);
    }

    public function setTranslate(string $name): string
    {
        $prefix = config('translatable.rule_factory.prefix');
        $suffix = config('translatable.rule_factory.suffix');

        return $prefix . $name . $suffix;
    }
}
