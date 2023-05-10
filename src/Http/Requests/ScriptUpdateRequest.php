<?php

declare(strict_types=1);

namespace Hexide\Seo\Http\Requests;

use Hexide\Seo\Models\SeoScript;
use Illuminate\Foundation\Http\FormRequest;

class ScriptUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        $types = implode(',', SeoScript::getTypes());

        return [
            'title' => ['required', 'string', 'max:191'],
            'type' => ['required', 'string', 'in:'.$types],
            'text' => ['required', 'string', 'max:50000'],
        ];
    }
}
