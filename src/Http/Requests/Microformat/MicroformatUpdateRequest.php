<?php

declare(strict_types=1);

namespace Hexide\Seo\Http\Requests\Microformat;

use Illuminate\Foundation\Http\FormRequest;

class MicroformatUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'text' => ['nullable', 'string', 'max:10000'],
        ];
    }
}
