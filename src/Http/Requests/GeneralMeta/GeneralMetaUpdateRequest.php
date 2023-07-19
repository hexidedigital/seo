<?php

declare(strict_types=1);

namespace Hexide\Seo\Http\Requests\GeneralMeta;

use Hexide\Seo\Facades\SeoHelper;
use Hexide\Seo\Http\Requests\Traits\HasTranslationRules;
use Illuminate\Foundation\Http\FormRequest;

class GeneralMetaUpdateRequest extends FormRequest
{
    use HasTranslationRules;

    public function rules(): array
    {
        $rules = [
            $this->formatName('title') => ['nullable', 'string', 'max:255'],
            $this->formatName('description') => ['nullable', 'string', 'max:255'],
            $this->formatName('keywords') => ['nullable', 'string', 'max:255'],
            $this->formatName('og_title') => ['nullable', 'string', 'max:255'],
            $this->formatName('og_description') => ['nullable', 'string', 'max:255'],
            $this->formatName('og_image') => ['nullable', 'image'],
        ];

        return SeoHelper::langRules($rules);
    }
}
