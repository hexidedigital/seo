<?php

declare(strict_types=1);

namespace Hexide\Seo\Http\Requests;

use Hexide\Seo\Models\SeoScript;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ScriptStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', Rule::in(SeoScript::getTypes())],
            'text' => ['required', 'string', 'max:50000'],
        ];
    }
}
