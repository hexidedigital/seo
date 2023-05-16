<?php

declare(strict_types=1);

namespace Hexide\Seo\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MicroformatStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'text' => ['nullable', 'string', 'max:10000'],
        ];
    }
}
