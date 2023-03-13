<?php

namespace Hexide\Seo\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MicroformatUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:191'],
            'text' => ['nullable', 'string', 'max:10000'],
        ];
    }
}
